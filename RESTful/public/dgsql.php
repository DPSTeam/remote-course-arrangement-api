<?php
//Author:@DGideas
//2016-02-08

/* This class provide a easy way to access to the database */
class DGsql_base
{
	protected $DGSQL = array();
	
	function __construct($sqlType="MySQL")
	{
		$this->DGSQL["sqlType"] = $sqlType; // Datbase type: MySQL, ...
		$this->DGSQL["database"] = array();
		$this->DGSQL["database"]["location"]
			= $GLOBALS["DGDATABASE"]["location"]; // The var
		$this->DGSQL["database"]["username"]
			= $GLOBALS["DGDATABASE"]["username"]; // $DGDATABASE
		$this->DGSQL["database"]["password"]
			= $GLOBALS["DGDATABASE"]["password"]; // is defined
		$this->DGSQL["database"]["dbname"]
			= $GLOBALS["DGDATABASE"]["dbname"]; // by private/secret.php
		$this->DGSQL["database"]["prefix"]
			= $GLOBALS["HOOKS_DATABASE"]["prefix"]; //Database prefix
		$this->DGSQL["database"]["expired"]
			= $GLOBALS["HOOKS_SESSION"]["max_expired_time"];
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
	public function sql($sqlQuery, $returnResult = true)
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
			
			if($returnResult == true)
			{
				$fetch_results = array();
				while($result = mysql_fetch_array($res, MYSQL_ASSOC))
				{
					array_push($fetch_results, $result);
				}
				mysql_free_result($res);
			}
			
			mysql_close();
			
			if($returnResult == true)
			{
				return $fetch_results;
			}
			else
			{
				return;
			}
		}
	}
}

/* This class provides some useful methods for some requirments */
class DGsql extends DGsql_base
{
	public function count_item($tableName)
	{
		$sql = "SELECT COUNT(*) FROM `".$this->DGSQL["database"]["prefix"]
			.$tableName."`;";
		
		$res = $this->sql($sql);
		return $res[0]["COUNT(*)"];
	}
	
	public function config_add($configName, $configValue=null)
	{
		$sql = "INSERT INTO `".$this->DGSQL["database"]["dbname"]
			."`.`".$this->DGSQL["database"]["prefix"]
			."config` (`config_id`, `config_name`, `config_value`)"
			."VALUES ('', '".$configName."', '".$configValue."');";
		
		$this->sql($sql, false); // Not need return vars
	}

	public function config_query($configName)
	{
		$sql = "SELECT * FROM `".$this->DGSQL["database"]["dbname"]
			."`.`".$this->DGSQL["database"]["prefix"]
			."config` WHERE `config_name` = \""
			.$configName."\";";
		
		$res = $this->sql($sql);
		return $res[0]["config_value"];
	}
	
	public function session_add($sessionToken)
	{
		if(isset($_SERVER["REMOTE_ADDR"]))
		{
			$sessionIP = $_SERVER["REMOTE_ADDR"];
		}
		else
		{
			$sessionIP = '127.0.0.1'; // localhost
		}
		
		$sql = "INSERT INTO `".$this->DGSQL["database"]["dbname"]
			."`.`".$this->DGSQL["database"]["prefix"]
			."session` (`session_id`, `session_time`, `session_token`,"
			."`session_ip`, `session_status`, `session_user`) VALUES"
			."(NULL, '".time()."', '".$sessionToken."', '".$sessionIP
			."', 'QUERY', NULL);";
		$this->sql($sql, false);
	}
    
	public function session_verified($sessionToken)
	{
		$sql = "SELECT * FROM `".$this->DGSQL["database"]["dbname"]
			."`.`".$this->DGSQL["database"]["prefix"]
			."session` WHERE `session_token`=\"".$sessionToken."\";";
		$return = array();
		$exist = false;
		foreach($this->sql($sql) as $res)
		{
			$exist = true;
			array_push($return, $res);
		}
		if($exist)
		{
			return $return;
		}
		else
		{
			return false;
		}
	}
	
    public function session_clean()
	{
		$sql = "SELECT * FROM `".$this->DGSQL["database"]["dbname"]."`.`"
			.$this->DGSQL["database"]["prefix"]."session`;";
		foreach($this->sql($sql) as $res)
		{
			if(time() - $res["session_time"]
				>= $this->DGSQL["database"]["expired"])
			{
				$sql = "DELETE FROM `".$this->DGSQL["database"]["dbname"]
					."`.`".$this->DGSQL["database"]["prefix"]
					."session` WHERE `".$this->DGSQL["database"]["prefix"]
					."session`.`session_id` = ".$res["session_id"].";";
				$this->sql($sql, false);
			}
		}
		return;
	}
	
}

?>