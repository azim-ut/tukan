<? use core\manager\ParamsManager;
use core\manager\SessionManager;
use core\manager\UserManager;
use core\service\App;
use core\service\FacebookAuthService;

include_once __DIR__ . "/../nav/start_empty.php" ?>
<?
$user = UserManager::current();
FacebookAuthService::getInstance()->log($_GET);
$appID       = App::context()->facebookAuthAppID();
$appSecret   = App::context()->facebookAuthSecret();
$redirectUrl = App::context()->facebookLoginRedirectURL();
$code        = ParamsManager::getParam("code");
$state       = ParamsManager::getParam("state");
$accessToken = ParamsManager::getParam("access_token");
$tokenType   = ParamsManager::getParam("token_type");
$expiresIn   = ParamsManager::getParam("expires_in");

FacebookAuthService::getInstance()->getToken();

/** got code, but still has no access_token */
if(!$user && $state === SessionManager::id() && $code != null && $accessToken == null){
    SessionManager::set("code", $code);
    $checkTokenPath = FacebookConstants::getTokenPath($appID, $appSecret, $code, $redirectUrl);
    header("Location: " . $checkTokenPath);
    return;
}

/** got access_token and */
if(!$user && $state === SessionManager::id() && $code === null && $accessToken != null){
    $code           = SessionManager::get("code");
    $checkTokenPath = FacebookConstants::checkTokenPath($code, $accessToken);
    $content = file_get_contents($checkTokenPath);
    FacebookAuthService::getInstance()->log($content);
    $res = json_decode($content);
    if(boolval($res->is_valid)){
        echo "Done!";
    }else{
        echo "Fail";
    }
}

if($state === SessionManager::id() && $code != null){
    FacebookConstants::getTokenPath($appID, $appSecret, $code, $redirectUrl);
}
?>
    <div class="row">
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
    </div>

<? include_once __DIR__ . "/../nav/footer_empty.php" ?>