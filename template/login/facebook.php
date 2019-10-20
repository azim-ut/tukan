<? use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\ParamsManager;
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
$token       = ParamsManager::getParam("token");
$tokenType   = ParamsManager::getParam("token_type");
$expiresIn   = ParamsManager::getParam("expires_in");


/** got code, but still has no access_token */
if(!$user && $state === SessionManager::id() && $code != null){
    $getTokenPath = FacebookConstants::getTokenPath($appID, $appSecret, $code, $redirectUrl);
    echo $getTokenPath;
    $content      = file_get_contents($getTokenPath);
    var_dump($content);
    $res          = json_decode($content);
    FacebookAuthService::getInstance()->log($res);
    $accessToken = $res->access_token ?? null;

    /** got access_token and */
    if($code != null && $token != null){
        $checkTokenPath = FacebookConstants::getTokenDebugPath($token, $accessToken);
        $content        = file_get_contents($checkTokenPath);
        $res            = json_decode($content);
        var_dump($res);
        FacebookAuthService::getInstance()->log($res);
        if(boolval($res->is_valid)){
            $infoPath = FacebookConstants::getUserInfoPath($accessToken);
            $content  = file_get_contents($infoPath);
            $info     = json_decode($content);
            var_dump($info);
            $id    = $info->id ?? 0;
            $name  = $info->name;
            $email = $info->email ?? null;
            try{
                $user = UserManager::facebook($info->id);
                FacebookAuthService::getInstance()->appendToSession(SessionManager::id(), $user->getId(), $token, $accessToken);
                header("Location:/");
            }catch(BadResultException $e){
                var_dump($e);
            }catch(NoUserException $e){
                var_dump($e);
            }
        }else{
            echo "Fail";
        }
    }
}else{
    var_dump($user, $state, SessionManager::id(), $code);
}

?>
    <div class="row">
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
    </div>

<? include_once __DIR__ . "/../nav/footer_empty.php" ?>