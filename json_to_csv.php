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
?>

<?php
foreach ($jsonDecoded as $serviceresult) {

    foreach ($serviceresult['data'] as $itemserviceresult) {
        echo '<hr>';
        foreach ($itemserviceresult['resultList'] as $resultlist) {

            foreach ($resultlist['resources'] as $resources) {
                echo '$resources : ' . $resources[0] . '<br/>';
            }

            echo 'Request Part Number : ' . $resultlist['requestedPartNum'] . '<br/>';
            echo 'Number Found : ' . $resultlist['numberFound'] . '<br/>';
            echo '<hr>';
            foreach ($resultlist['PartList'] as $partList) {
                // var_dump($partList);
                echo 'Item Id : ' . $partList['itemId'] . '<br/>';
                echo 'partNum : ' . $partList['partNum'] . '<br/>';
                foreach ($partList['manufacturer'] as $manufacturer) {
                    echo 'manufacture : ' . $manufacturer . '<br/>';
                    echo '<hr>';
                }

                foreach ($partList['resources'] as $resources) {
                    echo 'type : ' . $resources['type'] . '<br/>';
                    echo 'uri : ' . $resources['uri'] . '<br/>';
                    echo '<hr>';
                }

                foreach ($partList['InvOrg'] as $InvOrg) {
                    foreach ($InvOrg as $sources) {

                        echo 'currency : ' . $sources['currency'] . '<br/>';
                        echo 'sourceCd : ' . $sources['sourceCd'] . '<br/>';
                        echo 'displayName : ' . $sources['displayName'] . '<br/>';
                        echo '<hr>';
                    }
                }

                foreach ($partList['EnvData'] as $EnvData) {
                    foreach ($EnvData as $compliance) {

                        echo 'displayLabel : ' . $compliance['displayLabel'] . '<br/>';
                        echo 'displayValue : ' . $compliance['displayValue'] . '<br/>';
                        echo '<hr>';
                    }
                }


                echo 'desc : ' . $partList['desc'] . '<br/>';
                echo 'packageType : ' . $partList['packageType'] . '<br/>';

                echo '<hr>';
            }


        }
    }

}
fclose($fp);
?>

//echo $json_data;

//Finally, close the file pointer.
//fclose($fp);

