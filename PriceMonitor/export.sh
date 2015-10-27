#!/bin/bash
function scrapy_crawl {
	local SYSTEM;
	local TIME;
	TIME="$1";
	SYSTEM="$2";
	
	#scrapy crawl "${SYSTEM}" --output-format="json";
	scrapy crawl "${SYSTEM}" --output-format="json" -L "ERROR";
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

scrapy_crawl "$TIME" "emag.ro" &
scrapy_crawl "$TIME" "pcgarage.ro" &
scrapy_crawl "$TIME" "mediagalaxy.ro" &
scrapy_crawl "$TIME" "flanco.ro" &
scrapy_crawl "$TIME" "coradrive.ro" &
scrapy_crawl "$TIME" "azerty.ro" &
scrapy_crawl "$TIME" "cel.ro" &

clear
for job in `jobs -p`; do
	echo "wait jobs" ;
    wait $job;
done;
