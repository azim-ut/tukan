<?php
require_once(__DIR__ . "/../../core/core.php");
require_once(__DIR__."/../config.php");
require_once(__DIR__."/src/AuthRest.php");
require_once(__DIR__."/src/RestPreset.php");
require_once(__DIR__."/src/RestTags.php");
require_once(__DIR__."/src/RestPosts.php");
require_once(__DIR__."/src/WishRest.php");
require_once(__DIR__."/src/CartRest.php");
require_once(__DIR__."/src/OrderRest.php");

use core\Context;
use core\exception\RestNotFoundedException;
use core\RestController;

_define('GET',      'GET');
_define('POST',     'POST');
_define('PUT',      'PUT');
_define('DELETE',   'DELETE');

$toIndex = 2;
$doIndex = 3;
$context = Context::getInstance();
try{
    $REST           = array();
    $to             = trim($context->getUrlManager()->getDirByIndex($toIndex), "/");
    $method         = $_SERVER['REQUEST_METHOD'];
	$current        = getRestExecutor($to);

	if(!isset($current)){
		throw new RestNotFoundedException();
	}
    if(!$current){
        throw new RestNotFoundedException();
    }
    echo $current->run($method, $context->getUrlManager()->getDirs($doIndex));

}catch(RestNotFoundedException $e){
    $result = new RestController();
    echo $result->showError(404, "404: Page not found");
}catch(Exception $e){
    $result = new RestController();
    echo $result->showError($e->getCode(), $e->getMessage(), $e->getTraceAsString(), get_class($e), $e->getLine());
}

function getRestExecutor($to){
	switch($to){
		case "auth":	 		return new AuthRest(); break;
		case "tags":	 		return new RestTags(); break;
		case "posts":	 		return new RestPosts(); break;
		case "preset":	 		return new RestPreset(); break;
		case "wish":	 		return new WishRest(); break;
		case "cart":	 		return new CartRest(); break;
		case "order":	 		return new OrderRest(); break;
	}
}
