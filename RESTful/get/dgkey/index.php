<?php
//Author:@DGideas
//2016-02-07

require("../../include.php");

$requestHandle = new DGrst();
$sqlHandle = new DGsql();

$requestHandle->add_param("dgkey", $requestHandle->dgkey());
$requestHandle->add_param("code", "200");
print(json_encode($requestHandle->response()));

?>
