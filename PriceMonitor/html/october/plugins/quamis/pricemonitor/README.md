artisan commands: 
	php artisan create:model quamis.pricemonitor product
	php artisan plugin:refresh quamis.pricemonitor
	php artisan create:component quamis.pricemonitor ProductAdd

 
Conversie DB
	TRUNCATE  pricemonitor_october.quamis_pricemonitor_product;
	INSERT INTO pricemonitor_october.quamis_pricemonitor_product (url, id, active, spider) (SELECT `URL`, CONCAT(SUBSTRING(MD5(LOWER(`spider`)), 1, 3), ":", MD5(LOWER(`URL`))), 1, `spider` FROM pricemonitor.urls);
	
	TRUNCATE  pricemonitor_october.quamis_pricemonitor_product_logs;
	INSERT INTO pricemonitor_october.quamis_pricemonitor_product_logs (id, run_id, name, price, currency, created_at, updated_at) (
		SELECT 
			CONCAT(SUBSTRING(MD5(LOWER(`spider`)), 1, 3), ":", MD5(LOWER(`URL`))),
			`run_id`,
			`name`,
			`price`,
			`currency`,
			`addTime`,
			`lastSeen`
		FROM pricemonitor.products AS url
	);


	
use DB;	
public function onRun()
{
	// https://octobercms.com/docs/plugin/components
	
	
	// http://laravel.com/docs/4.2/database
	// http://laravel.com/docs/4.2/schema#adding-indexes
	// $results = DB::select('select * from users where id = ?', array(1));
	// $this->property('maxItems', 6);
	// $properties = $this->getProperties();
	
	// $this->page['var'] = 'value'; // Inject some variable to the page 
	
	// {% partial 'ProductDetails::ProductDetails' %}
	// $this->page['var'] = 'xxxx-value-yyyy'; // Inject some variable to the page 



	 
	#$results = Db::connection()->select('SELECT * FROM `products` WHERE `id` = ? ORDER BY `lastSeen` DESC LIMIT 1', array($this->property('id')));
	#$this->details = $results[0];

	return parent::onRun();
}



TODO:
	x suport pt redirect tracking, pt ca se pierd id-urile interne in urma redirecturilor
	x adaua suport in spiders pt a face gather doar la itemurile noi(pe care sa il rulez apoi dupa ce adaug un link nou si sa ruleze doar pt ceea ce e nevoie)
	- suport pt category list
	- adauga suport pt auto-extract tags & descriptions
	- adauga suport in atribute pt "productId" si sa poti unifica acelasi produs pe mai multe site-uri (gen hdd sdd V300, care e pe orice site de IT, dar e sub alt pret mereu). Acest id ar trebui adaugat manual presupun, sau facut o lista de sugestii.
	- adauga un tabel de "spiderlog" in care sa marchezi cand ruleaza spiderul, si sa stii ultima data cand a fost rulat u anumit spider
		- adauga apoi suport pt "auto-deactivate" per produs. Practic se va uita cand a rulat ultima oara un spider, si dezactiveaza produsele care nu au mai fost updatate de la lastRun-48h
