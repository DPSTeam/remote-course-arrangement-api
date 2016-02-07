<?php
	require("../RESTful/include.php");
	
	$dbHandle = new DGsql();
	
	$config_params = array(
		"dgrca_version" => "1.0",
		"site_status" => "OK",
		"site_addr" => "localhost",
		"site_name" => "Another DGSite",
		"site_lang" => "zh-CN",
		"site_charset" => "utf-8",
		"api_version" => "1.0",
		"api_status" => "OK",
		"api_query_freq" => "unlimited",
		"api_query_times" => "1"
		);
	
	// Insert sone data to `config`
	foreach($config_params as $configName => $configValue)
	{
		$dbHandle->config_add($configName, $configValue);
	}
?>
