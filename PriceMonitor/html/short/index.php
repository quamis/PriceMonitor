<?php
ini_set('display_errors', '1');
error_reporting(-1);
date_default_timezone_set('UTC');

define('TIMESTAMP', microtime(true));
require_once("db.cfg.php");


class DB {
	static $instance = null;
	static public function getInstance() {
		if (self::$instance==null) {
			self::$instance = new self();
			self::$instance->connect();
		}
		
		return self::$instance;
	}
	
	
	protected $db = null;
	
	public function connect() {
		try {
			$this->db = new PDO(DB_DSN, DB_USER, DB_PASS);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (PDOException $e) {
			echo 'DB Connection failed';
		}
		
		return $this;
	}
	
	public function getAssoc($query) {
		#return $this->db->query($query, PDO::FETCH_ASSOC);
		$results = Array();
		foreach($this->db->query($query, PDO::FETCH_ASSOC) as $res) {
			$results[]= $res;
		}
		
		return $results;
	}
	public function getRow($query) {
		$result = $this->db->query($query, PDO::FETCH_ASSOC)->fetch();
		return $result;
	}
	
	public function getOne($query) {
		$result = $this->db->query($query, PDO::FETCH_ASSOC)->fetch();
		return reset($result);
	}
}

class Products {
	public function getAll() {
		$results = DB::getInstance()->getAssoc("SELECT `id` FROM products GROUP BY `id` ORDER BY `name` ASC");
		return $results;
	}
	public function getLastRunTime() {
		$lastRow = DB::getInstance()->getRow("SELECT MAX(`lastSeen`), `run_id` FROM `products`");
		$lastRunTime = DB::getInstance()->getOne("SELECT MIN(`lastSeen`) FROM `products` WHERE `run_id`='{$lastRow['run_id']}'");
		return $lastRunTime;
	}
	public function getAvailable() {
		$results = DB::getInstance()->getAssoc("SELECT `id`, `spider` FROM products WHERE `lastSeen`>='{$this->getLastRunTime()}' GROUP BY `id` ORDER BY `name` ASC");
		return $results;
	}
}

class Product {
	protected $id = null;
	protected $spider = null;
	protected $data = null;
	
	protected $date_tz = null;
	
	public function __construct($id, $spider)
	{
		$this->id = $id;
		$this->spider = $spider;
		
		$this->date_tz  = new DateTimeZone('Europe/Bucharest');
	}
	
	function getHistory() {
		$history = DB::getInstance()->getAssoc("SELECT * FROM `products` WHERE `id`='{$this->id}' AND `spider`='{$this->spider}' ORDER BY `lastSeen` DESC");
		foreach($history as $k=>$hist) {
			$hist['addTime_obj'] = $this->createDate($hist['addTime']);
			$hist['lastSeen_obj'] = $this->createDate($hist['lastSeen']);
		
			$hist['isAvailable'] = $this->isAvailable() || ($this->getAge($hist['lastSeen_obj'])<(60*60*24));
			
			$hist['addTime_str'] = $hist['addTime_obj']->format("Y-m-d H:i:s");
			$hist['lastSeen_str'] = $hist['lastSeen_obj']->format("Y-m-d H:i:s");
			
			$history[$k] = $hist;
		}
		return $history;
	}
	
	function isAvailable()
	{
		return $this->getData()['isAvailable'];
	}
	
	function getData() {
		if ($this->data!==null) {
			return $this->data;
		}
		$this->data = DB::getInstance()->getRow("SELECT * FROM `products` WHERE `id`='{$this->id}' AND `spider`='{$this->spider}'ORDER BY `lastSeen` DESC LIMIT 1");
		
		$this->data['addTime_obj'] = $this->createDate($this->data['addTime']);
		$this->data['lastSeen_obj'] = $this->createDate($this->data['lastSeen']);
		
		$this->data['isAvailable'] = ($this->getAge($this->data['lastSeen_obj'])<(60*60*24));
		
		$this->data['addTime_str'] = $this->data['addTime_obj']->format("Y-m-d H:i:s");
		$this->data['lastSeen_str'] = $this->data['addTime_obj']->format("Y-m-d H:i:s");
		
		return $this->data;
	}
	
	protected function createDate($dateStr) {
		$dtObj = DateTime::createFromFormat("Y-m-d H:i:s", $dateStr, new DateTimeZone('UTC'));
		$dtObj->setTimeZone($this->date_tz);
		
		return $dtObj;
	}

	public function getAge($date)
	{
		return (TIMESTAMP - $date->getTimestamp());
	}
}


/*
$products = new Products();
foreach ($products->getAvailable() as $rawProd) {
	$prod = new Product($rawProd['id'], $rawProd['spider']);
	var_dump($prod->getHistory());
}
*/



?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=yes">
	
	<title>price monitor - availabile info</title>
	<script>document.write('<base href="' + document.location + '" />');</script>
	
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/index.css" media="only screen and (min-device-width: 100px)" />
</head>

<body>
	<div class='stats'>
		<div>
			<span class='label'>recorded items</span>
			<span class='value'>-</span>
		</div>
	</div>
	
	<div class='history'>
		<table class="products">
			<?php 
				$priceDiffs = Array(
					'diff-500'=>0.500, 
					'diff-200'=>0.200, 
					'diff-150'=>0.150, 
					'diff-100'=>0.100, 
					'diff-050'=>0.050, 
					'diff-020'=>0.020, 
					'diff-010'=>0.010,
					'diff-005'=>0.005,
					'diff-001'=>0.001,
				);
				
				$products = new Products();
				foreach ($products->getAvailable() as $rawProd) {
					$prod = new Product($rawProd['id'], $rawProd['spider']);
					$data = $prod->getData();
					
					$history = $prod->getHistory();
					foreach ($history as $k=>$hist) {
						if($hist['run_id']==$data['run_id']) {
							unset($history[$k]);
						}
					}
					
					/* compute the class relative to the first item in history */
					$trClass = Array();
					$fhist = reset($history);
					$sign = 0;
					$adiff = 0;
					if ($fhist) {
						if ($fhist['price']>$data['price']) {
							$trClass[]= "price-lower";
							$sign = -1;
						}
						elseif ($fhist['price']<$data['price']) {
							$trClass[]= "price-higher";
							$sign = +1;
						}
						
						$adiff = min($fhist['price'], $data['price'])/max($fhist['price'], $data['price']);
						foreach ($priceDiffs as $cls=>$diff) {
							$diffl = (1-$diff);
							
							if ($adiff<$diffl) {
								$trClass[]= $cls;
								break;
							}
						}
					}
					
					$trClass[] = ($data['isAvailable']?'available':'unavailable');
					
			?>
				<tbody>
					<tr class="current <?=implode(" ", $trClass)?>">
						<td class="name" rowspan="<?=count($history)+1?>"><?=$data['name']?></td>
						<td class="price"><span class='value'><?=number_format($data['price'], 2)?></span> <span class='currency'><?=$data['currency']?><span></td>
						<td class="priceDetails"><?php
						if ($sign) {
							printf("%s%s%%", ($sign>0?'+':'-'), number_format((1-$adiff)*100, 3));
						}
						?></td>
						<td class="URL" rowspan="<?=count($history)+1?>"><a href="<?=$data['URL']?>" target="_blank"><?=$data['spider']?></a></td>
						<td class="addTime"><?=$data['addTime_str']?></td>
						<td class="lastSeen"><?=$data['lastSeen_str']?></td>
					</tr>
					
					<?php 
						$lhist = $data;
						$hidx = -1;
						foreach ($history as $hist) {
							$hidx++;
							$trClass = Array();
							$sign = 0;
							if ($lhist['price']>$hist['price']) {
								$trClass[]= "price-lower";
								$sign = -1;
							}
							elseif ($lhist['price']<$hist['price']) {
								$trClass[]= "price-higher";
								$sign = +1;
							}
							
							$adiff = min($lhist['price'], $hist['price'])/max($lhist['price'], $hist['price']);
							foreach ($priceDiffs as $cls=>$diff) {
								$diffl = (1-$diff);
								
								if ($adiff<$diffl) {
									$trClass[]= $cls;
									break;
								}
							}
							
							$trClass[] = ($hist['isAvailable']?'available':'unavailable');
							
							?>
							<tr class="history <?=implode(" ", $trClass)?>">
								<td class="price"><span class='value'><?=number_format($hist['price'], 2)?></span> <span class='currency'><?=$hist['currency']?><span></td>
								<td class="priceDetails"><?php
								if ($sign && $hidx>0) {
									printf("%s%s%%", ($sign>0?'+':'-'), number_format((1-$adiff)*100, 3));
								}
								?></td>
								<td class="addTime"><?=$hist['addTime']?></td>
								<td class="lastSeen"><?=$hist['lastSeen']?></td>
							</tr>
							<?php
						}
					?>
				</tbody>
			<?php 
				}
			?>
		</table>
	</div>
	
	<!--
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.2/underscore-min.js"></script>
	
	<script type="text/javascript" src= "lib/index.js"></script>
	-->
</body>
</html>
