<?php
//Author:@DGideas
//2016-02-08

require("../../include.php");

$queryHandle=new DGrst();
$sqlHandle=new DGsql();

$sqlHandle->session_clean();

if(!isset($_POST["username"]) || !isset($_POST["password"])
	|| !isset($_POST["token"]))
{
	$queryHandle->code('403', 'Bad arguments');
}
else
{
	$verified = $sqlHandle->session_verified($_POST["token"]);
	
	if($verified)
	{
		if(!isset($_SERVER["REMOTE_ADDR"]))
		{
			$localIP = "127.0.0.1";
		}
		else
		{
			$localIP = $_SERVER["REMOTE_ADDR"];
		}
	}
	else
	{
		$queryHandle->code('403', 'Bad token');
	}
}

// Next step, verified username and password
if($queryHandle->get_code() == "200")
{
	$userId = $sqlHandle->user_get_id($_POST["username"]);
	if($sqlHandle->user_login($userId, $_POST["password"], $_POST["token"]))
	{
		$requestHandle->code("200", "Success");
	}
	else
	{
		$requestHandle->code("403", "Authentication failed");
	}
}

print(json_encode($queryHandle->response()));
?>
