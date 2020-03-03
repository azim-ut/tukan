<?php

use core\manager\ParamsManager;
use core\service\App;
use core\service\FacebookChatService;
use core\service\MySqlService;
use core\utils\ServerUtils;
use core\utils\StringUtils;

$accessToken      = App::context()->prop("chat.access.token");
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

$recipientID      = ($input->entry[0]->messaging[0]->recipient->id) ?? - 1;
$senderID         = ($input->entry[0]->messaging[0]->sender->id) ?? - 1;
$messageInputText = ($input->entry[0]->messaging[0]->message->text) ?? null;
if(StringUtils::isEmpty($messageInputText) || strpos($messageInputText, "test") === false){
    exit();
}
FacebookChatService::getInstance()->log([$recipientID, $senderID, $messageInputText]);


//Send sender action to Facebook Messenger - typing on
$response                = new stdClass();
$response->recipient->id = $senderID;
$response->sender_action = "typing_on";

sendToFacebookMessage($response, $accessToken);
$apiResponse = json_decode($content);

//Send message
$response                = new stdClass();
$response->recipient->id = $senderID;
$response->message->text = "Hello!";
sendToFacebookMessage($response, $accessToken);

function sendToFacebookMessage($data, $accessToken){
    $api_url     = 'https://graph.facebook.com/v4.0/me/messages?access_token=' . $accessToken;
    $httpHeaders = ['Content-Type: application/json'];
//    FacebookChatService::getInstance()->log(json_encode($data));
    $content = ServerUtils::curlPost($api_url, json_encode($data), $httpHeaders);
    FacebookChatService::getInstance()->log($content);
}