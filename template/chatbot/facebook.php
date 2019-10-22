<?php

use core\manager\ParamsManager;

$access_token     = "EAAGipka04bgBALkxrZB8qhg3JLHfRq5D8wMtZCsj0XVxTfTZBr9YFxNfI19Ka0bTlVrA3dY6hUO91WuNpBpGY5OPKgIOCY4hfuccYuZAt5bcjXTvuouMWcD4ZC4ZCN6nzfnZCguRkeSoZCv1GJIbsv6lhqYEd6Lbga3AZCVsPoRQQ5fQmN6jZCKeD9";
$verify_token     = "fb_time_bot";
$hub_verify_token = null;
$hubChallenge     = ParamsManager::getParam("hub_challenge");
$hubVerifyToken   = ParamsManager::getParam("hub_verify_token");
if($hubChallenge){
    $challenge        = $hubChallenge;
    $hub_verify_token = $hubVerifyToken;
}


if($hub_verify_token === $verify_token){
    echo $challenge;
}