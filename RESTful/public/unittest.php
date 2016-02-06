<?php
	require('restful.php');
	$classHandle=new DGrst();
	var_dump($classHandle->response());
	require('dgsql.php');
	$classHandle=new DGsql();
	print("Done\n");
?>
