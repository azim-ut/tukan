<?php

use core\manager\ParamsManager;
use core\service\FacebookChatService;
use core\service\MySqlService;

$access_token     = "EAAGipka04bgBALkxrZB8qhg3JLHfRq5D8wMtZCsj0XVxTfTZBr9YFxNfI19Ka0bTlVrA3dY6hUO91WuNpBpGY5OPKgIOCY4hfuccYuZAt5bcjXTvuouMWcD4ZC4ZCN6nzfnZCguRkeSoZCv1GJIbsv6lhqYEd6Lbga3AZCVsPoRQQ5fQmN6jZCKeD9";
$verify_token     = "fb_time_bot";
$hub_verify_token = null;
$hubChallenge     = ParamsManager::getParam("hub_challenge");
$hubVerifyToken   = ParamsManager::getParam("hub_verify_token");
$sql              = MySqlService::getInstance();
if($hubChallenge){
    $challenge        = $hubChallenge;
    $hub_verify_token = $hubVerifyToken;
}


if($hub_verify_token === $verify_token){
    echo $challenge;
    exit();
}

$input = json_decode(file_get_contents('php://input'));

$recipientID = ($input->entry[0]->messaging[0]->recipient->id)??-1;
$senderID = ($input->entry[0]->messaging[0]->sender->id)??-1;
$messageInputText = ($input->entry[0]->messaging[0]->text)??"Hi";

FacebookChatService::getInstance()->log([$recipientID, $senderID, $messageInputText]);

