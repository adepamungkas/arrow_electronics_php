<?php

//$api source
$api_url = 'http://api.arrow.com//itemservice/v3/en/search/list?req={"request":{"login":"supremecomponents","apikey":"07b23129ead7328ca4f14a9c08fa89f333e30d08042a5ec4d211e7b66851825d","remoteIp":"192.168.102.188","useExact":true,"parts":[{"partNum":"bav99","mfr":"NXP"},{"partNum":"MT47H128M8HQ-3:E"},{"partNum":"TMP275AIDGKT"}]}}';

// Read JSON file
$json_data = file_get_contents($api_url);

header('Content-disposition: attachment; filename=jsonFile.json');
header('Content-type: application/json');

echo( $json_data);

