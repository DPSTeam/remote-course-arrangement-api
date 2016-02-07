<?php
//Author:@DGideas
//2016-02-06

// DGrst is a class for PHP based RESTful API driver.
class DGrst
{
	protected $RST = array(); // Construct a protected array for class
	
	function __construct()
	{
		$this->RST["request"] = array(); //Request array, for request
		$this->RST["response"] = array(); // Response array, for callback
		$this->RST["response"]["rst_version"] = "1.0"; //RESTful API version
		$this->RST["response"]["rst_time"] = (int)time(); //RESTful API UNIX time
		$this->RST["response"]["rst_code"] = "200"; //HTTP 200 OK
	}
	
	/* This method can parse requests */
	public function parse()
	{
		
	}
	
	/* This function will generate a secret key via dgkey() */
	public function dgkey()
	{
		$dgKey = md5((string)$_SERVER["REQUEST_TIME"]);
		return $dgKey;
	}
	
	/* This function provides a method to verified a public key is true or not */
	public function verified($publicKey)
	{
		
	}
	
	/* add a new param for response array */
	public function add_param($param, $content)
	{
		if(isset($this->RST["response"][$param]))
		{
			return false;
		}
		
		$this->RST["response"][$param] = $content;
		return true;
	}
	
	/* Change the HTTP response code */
	public function code($HTTPCode)
	{
		$this->RST["response"]["rst_code"] = $HTTPCode;
	}
	
	/* Get response array */
	public function response()
	{
		return $this->RST["response"];
	}
}
?>
