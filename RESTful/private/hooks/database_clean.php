<?php
//Author:@DGideas
//2015-02-08

// Automatically clean dgkey record which exists bigger than 4 hour
$sqlHandle = new DGsql();
$sql = "SELECT * FROM `".$this->["database"]["dbname"]."`.
?>
