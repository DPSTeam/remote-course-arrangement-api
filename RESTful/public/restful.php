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
		$this->RST["response"]["version"] = "1.0"; //RESTful API version
		$this->RST["response"]["rst_time"] = (int)time(); //RESTful API UNIX time
	}
	
	/* This method can parse the GET request and POST request */
	public function parse()
	{
		
	}
	
	/* add a new param for response array */
	public function add_param($param, $content)
	{
		
	}
	
	/* Get response array */
	public function response()
	{
		return $this->RST["response"];
	}
}
?>
