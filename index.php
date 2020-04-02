
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>simple CRUD</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datepicker.min.css" rel="stylesheet">

    <!-- styles -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>
<body>

<div class="container ">
    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <li><a href="download_json.php">Download Json</a></li>
                    <li><a href="json_to_csv.php">Export CSV</a></li>
                    <li><a href="raw_json.php">Raw Json</a></li>

                </ul>

            </div><!--/.nav-collapse -->

        </div><!--/.container-fluid -->
    </nav>

</div>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h4>
                    <form class="form-inline" method="POST" action="index.php">
                        <div class="form-group">
                            <div class="input-group">

                                <input type="text" class="form-control" name="cari" placeholder="Cari ..."
                                       autocomplete="off" value="">
                                <div class="input-group-addon ">
                                    <i class="glyphicon glyphicon-search "></i>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-success pull-right" href="?page=add">
                            <i class="glyphicon glyphicon-plus"></i> Tambah
                        </a>
                    </form>

                </h4>
            </div>



            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Parse Data Jason To HTML</h3>
                </div>
                <div class="panel-body">
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
                    //$fp = fopen($csvFileName, 'w');
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

                                    }
                                    echo '<br/>';
                                    foreach ($partList['resources'] as $resources) {
                                        echo 'type : ' . $resources['type'] . '<br/>';
                                        echo 'uri : ' . $resources['uri'] . '<br/>';
                                        echo '<br/>';;
                                    }

                                    foreach ($partList['InvOrg'] as $InvOrg) {
                                        foreach ($InvOrg as $sources) {

                                            echo 'currency : ' . $sources['currency'] . '<br/>';
                                            echo 'sourceCd : ' . $sources['sourceCd'] . '<br/>';
                                            echo 'displayName : ' . $sources['displayName'] . '<br/>';
                                            echo '<br/>';
                                        }
                                    }

                                    foreach ($partList['EnvData'] as $EnvData) {
                                        foreach ($EnvData as $compliance) {

                                            echo 'displayLabel : ' . $compliance['displayLabel'] . '<br/>';
                                            echo 'displayValue : ' . $compliance['displayValue'] . '<br/>';
                                            echo '<br/>';;
                                        }
                                    }


                                    echo 'desc : ' . $partList['desc'] . '<br/>';
                                    echo 'packageType : ' . $partList['packageType'] . '<br/>';

                                    echo '<hr>';
                                }


                            }
                        }

                    }

                    ?>


                </div>
            </div> <!-- /.panel -->
        </div> <!-- /.col -->
    </div> <!-- /.row -->
</div> <!-- /.container-fluid -->
<div class="container">
    <footer class="footer bg-primary">

        <p class="text-info text-center">&copy; 2017 Ade Pamungkas</p>
        <p class="text-muted text-center ">Powered by <a href="http://www.getbootstrap.com" target="_blank">Bootstrap</a></p>

    </footer>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(function () {

        //datepicker plugin
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        // toolip
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
</body>
</html>