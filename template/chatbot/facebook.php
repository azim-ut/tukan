<?php
$access_token = "EAAGipka04bgBALkxrZB8qhg3JLHfRq5D8wMtZCsj0XVxTfTZBr9YFxNfI19Ka0bTlVrA3dY6hUO91WuNpBpGY5OPKgIOCY4hfuccYuZAt5bcjXTvuouMWcD4ZC4ZCN6nzfnZCguRkeSoZCv1GJIbsv6lhqYEd6Lbga3AZCVsPoRQQ5fQmN6jZCKeD9";
$verify_token = "fb_time_bot";
$hub_verify_token = null;

if(isset($_REQUEST['hub_challenge'])) {
	$challenge = $_REQUEST['hub_challenge'];
	$hub_verify_token = $_REQUEST['hub_verify_token'];
}


if ($hub_verify_token === $verify_token) {
	echo $challenge;
}