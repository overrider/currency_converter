#!/usr/bin/php -q
<?php

	// Get your own Key for openexchangerates.org or adapt to your rates feed of choice
	define('API_KEY', '');

	// Decide where to store the rates file
	$currency_file = "/home/user/.currencies.json";

	$currency_file_url = "http://openexchangerates.org/api/latest.json?app_id=".API_KEY;
	$now = time();
	$currency_file_mtime = "";
	$age = "";

	function convert($from_cur,$to_cur,$amount){
		global $data;

		$from_cur = strtoupper($from_cur);
		$to_cur = strtoupper($to_cur);

		if(!isset($data->$from_cur)){
			die("Unknown currency code $from_cur\n");	
		}

		if(!isset($data->$to_cur)){
			die("Unknown currency code $to_cur\n");	
		}

		if(!is_numeric($amount)){
			die("$amount does not seem to be numeric!\n");
		}

		$result = $amount / $data->$from_cur;
		$result = $result * $data->$to_cur;
		
		print "$amount $from_cur = $result $to_cur\n";
	}


	if(file_exists($currency_file)){
		$currency_file_mtime = filemtime($currency_file);
		$age = $now - $currency_file_mtime;
	} else {
		$data = file_get_contents($currency_file_url);
		file_put_contents($currency_file,$data);
	}

	if($age > 3000 || $age == ""){
		print "Updating the Database\n";
		$data = file_get_contents($currency_file_url);
		file_put_contents($currency_file,$data);
	}

	$data = file_get_contents($currency_file);
	$data = json_decode($data);
	$data = $data->rates;
	
	$from_cur = @$argv[1];
	$to_cur = @$argv[2];
	$amount = @$argv[3];

	if(empty($from_cur)){
		convert("USD","CNY",1);
		convert("CNY","USD",1);
		convert("CNY","HKD",1);
	} else {	
		convert($from_cur,$to_cur,$amount);
	}
?>
