<?php
//Author:@DGideas
//2016-02-07

/* This class provide a easy way to access to the database */
class DGsql_base
{
	protected $DGSQL = array();
	
	function __construct($sqlType="MySQL")
	{
		$this->DGSQL["sqlType"] = $sqlType; // Datbase type: MySQL, ...
		$this->DGSQL["database"] = array();
		$this->DGSQL["database"]["location"] = $GLOBALS["DGDATABASE"]["location"]; // The var
		$this->DGSQL["database"]["username"] = $GLOBALS["DGDATABASE"]["username"]; // $DGDATABASE
		$this->DGSQL["database"]["password"] = $GLOBALS["DGDATABASE"]["password"]; // is defined
		$this->DGSQL["database"]["dbname"] = $GLOBALS["DGDATABASE"]["dbname"]; // by private/secret.php
		$this->DGSQL["database"]["prefix"] = $GLOBALS["HOOKS_DATABASE"]["prefix"]; //Database prefix
	}
	
	/* This function can get the MySQL status */
	public function status()
	{
		if($this->DGSQL["sqlType"] == "MySQL")
		{
			$sqlHandle = mysql_connect(
				$this->DGSQL["database"]["location"],
				$this->DGSQL["database"]["username"],
				$this->DGSQL["database"]["password"]);
			
			$status = explode("  ", mysql_stat($sqlHandle));
			return $status;
		}
	}
	
	/* This function can excute the $sqlQuery and return the result cluster */
	public function sql($sqlQuery)
	{
		if($this->DGSQL["sqlType"] == "MySQL")
		{
			$sqlHandle = mysql_connect(
				$this->DGSQL["database"]["location"],
				$this->DGSQL["database"]["username"],
				$this->DGSQL["database"]["password"]);
			
			mysql_select_db(
				$this->DGSQL["database"]["dbname"]);
			
			$res = mysql_query($sqlQuery);
			$fetch_results = mysql_fetch_object($res);
			
			mysql_free_result();
			mysql_close();
			
			return $fetch_results;
		}
	}
}

/* This class provides some useful methods for some requirments */
class DGsql extends DGsql_base
{
	public function config_add($configName, $configValue=null)
	{
		$this->sql(
			"INSERT INTO `".$this->DGSQL["database"]["dbname"]
			."`.`".$this->DGSQL["database"]["prefix"]
			."config` (`config_id`, `config_name`, `config_value`)"
			."VALUES ('', '".$configName."', '".$configValue."');");
	}
}

?>
