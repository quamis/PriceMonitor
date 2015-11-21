#!/bin/bash
function scrapy_crawl {
	local spider;
	local TIME;
	local update_type
	TIME="$1";
	spider="$2";
	update_type="$3";
	
	touch "/tmp/PriceMonitor/$TIME/$spider"
	
	sleep $[ ( $RANDOM % 15 ) ]
	
	#scrapy crawl "${spider}" --output-format="json" -L "ERROR" -a update_type="all";
	#scrapy crawl "${spider}" --output-format="json" -L "ERROR" -a update_type="new";
	#scrapy crawl "${spider}" --output-format="json" -L "ERROR" -a update_type="update-missing-attributes";
	scrapy crawl "${spider}" --output-format="json" -L "ERROR" -a update_type="$update_type";
	
	rm -f "/tmp/PriceMonitor/$TIME/$spider"
}

# chdor to the script directory
F="`readlink -f $0`"
DIR=`dirname "$F"`
cd "$DIR"

#TIME=`date "+%Y%m%d-%H%M%S"`
#TIME=`date "+%Y%m%d-%H0000"`
M=`date "+%M"|sed s/^0//`
M=`printf "%02d" $(( (M/5)*5 ))`
TIME=`date "+%Y%m%d-%H${M}00"`

SPIDERS=("emag.ro" "pcgarage.ro" "mediagalaxy.ro" "flanco.ro" "coradrive.ro" "azerty.ro" "cel.ro" "noriel.ro" "promomix.ro" "mediadot.ro" "babymar.ro" "bebebliss.ro" "carucioaredecopii.ro" "oktal.ro")

update_type="$1"
: ${update_type:="all"}

clear
rm -rf "/tmp/PriceMonitor/$TIME"
mkdir -p "/tmp/PriceMonitor/$TIME/"
for spider in "${SPIDERS[@]}"
do
   echo "start $spider, $update_type items"
   (scrapy_crawl "$TIME" "$spider" "$update_type") &
done

#JOBS=`jobs -p|wc -l`
JOBS=1;
JOBS_INIT="${#SPIDERS[@]}"
echo -e "\n\n";
echo " +"
while [ $JOBS -gt 0 ]; do
	#JOBS=`jobs -p|wc -l`;
	JOBS=`ls -1 "/tmp/PriceMonitor/$TIME/"|wc -l`;
	echo " |-> wait $JOBS/$JOBS_INIT: `ls -1 "/tmp/PriceMonitor/$TIME/" | tr "\n" " "`";
	sleep 2.5;
done
echo " +";


rm -rf "/tmp/PriceMonitor/$TIME"

#for job in `jobs -p`; do
#	echo "wait `jobs -p|wc -l` jobs";
#    wait $job;
#done;
