<?php


//$api_url = 'http://dummy.restapiexample.com/api/v1/employees';
$api_url = 'http://api.arrow.com//itemservice/v3/en/search/list?req={"request":{"login":"supremecomponents","apikey":"07b23129ead7328ca4f14a9c08fa89f333e30d08042a5ec4d211e7b66851825d","remoteIp":"192.168.102.188","useExact":true,"parts":[{"partNum":"bav99","mfr":"NXP"},{"partNum":"MT47H128M8HQ-3:E"},{"partNum":"TMP275AIDGKT"}]}}';
// Read JSON file
$json_data = file_get_contents($api_url);

// Decode JSON data into PHP array
//$user_data = json_decode($json_data);
$jsonDecoded = json_decode($json_data, true);

//Give our CSV file a name.
$csvFileName = 'example.csv';

//Open file pointer.
$fp = fopen($csvFileName, 'w');
//Loop through the associative array.
//foreach($jsonDecoded as $row){
//    //Write the row to the CSV file.
//
//    fputcsv($fp, $row);
//}


echo $json_data;

//Finally, close the file pointer.
//fclose($fp);

