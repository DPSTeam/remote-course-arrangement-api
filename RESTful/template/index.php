<?php
//Author:@DGideas
//2016-02-07

require("../../include.php");

$requestHandle = new DGrst();
$sqlHandle = new DGsql();



print(json_encode($requestHandle->response()));
?>
