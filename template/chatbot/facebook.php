<?php
$access_token = "EAAGipka04bgBAIIHDEUprONwZCEPkRHwYiICxZAMTLCXfiN9dYMDh3dQ4kTMZBZC3PeJgiEKQL46P1n78tBtpKEz5ZB68ZBWy9bu5m9MiJvSw3BExRPFpQ0eRCKRsZCA0bj2Knsw5ZAh25GAkjZA7tPdjf3Limj2IrOA0NcO7Yp3TVT7hKWqqO0aF";
$verify_token = "fb_time_bot";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
	$challenge = $_REQUEST['hub_challenge'];
	$hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
	echo $challenge;
}