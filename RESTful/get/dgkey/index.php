<?php
//Author:@DGideas
//2016-02-07

require("../../include.php");

$requestHandle = new DGrst();
$sqlHandle = new DGsql();

$key = $requestHandle->dgkey();
$requestHandle->add_param("dgkey", $key);

print(json_encode($requestHandle->response()));
$sqlHandle->session_add($key);
?>
