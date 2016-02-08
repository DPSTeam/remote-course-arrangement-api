<?php
//Author:@DGideas
//2016-02-07

require("../../include.php");

$requestHandle = new DGrst();
$sqlHandle = new DGsql();

$sqlHandle->session_clean();
$key = $requestHandle->token();
$requestHandle->add_param("token", $key);

print(json_encode($requestHandle->response()));
$sqlHandle->session_add($key);
?>
