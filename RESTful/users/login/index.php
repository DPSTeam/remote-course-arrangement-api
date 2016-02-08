<?php
//Author:@DGideas
//2016-02-06

require("../../include.php");

$queryHandle=new DGrst();
$sqlHandle=new DGsql();

if(!isset($_POST["username"]) || !isset($_POST["password"]
	|| !isset($_POST["token"])))
{
	$queryHandle->code('403', 'Bad arguments');
}
else
{
	
}

print(json_encode($queryHandle->response()));
?>
