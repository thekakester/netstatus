<?php
	// Turn off all error reporting
	//error_reporting(0);

	$url = $_GET['url'];
	$port = $_GET['port'];
	$timeout = $_GET['timeout']-0;
	//echo "$url<Br>";
	
	//This is needed for urls that redirect
	/*$context = array(
		'http'=>array('max_redirects' => 99, 'timeout' => $timeout)
	);
	$context = stream_context_create($context);
	
	// connect via SSL, but don't check cert
	$handle=curl_init($url);
	curl_setopt($handle, CURLOPT_VERBOSE, true);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
	//curl_setopt($handle, CURLOPT_CAINFO, 'cacert.pem');
	$content = curl_exec($handle);*/

	//echo "###$content###"; // show target page
	/*$file = fopen($url,'r', false, $context);*/
	
	
	// Function to check response time
	function pingDomain($domain,$port,$timeout){
		$starttime = microtime(true);
		$file      = fsockopen ($domain, $port, $errno, $errstr, $timeout);
		$stoptime  = microtime(true);
		$status    = 0;

		if (!$file) $status = -1;  // Site is down
		else {
			fclose($file);
			$status = ($stoptime - $starttime) * 1000;
			$status = floor($status);
		}
		return $status;
	}
	
	
	if (pingDomain($url,$port,$timeout) > -1) {
		echo "1";
	} else {
		echo "0";
	}
?>