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
FacebookAuthService::getInstance()->log("income", $_GET);
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
	$getTokenPath = FacebookConstants::changeCodeToAccessTokenPath($appID, $appSecret, $code, $redirectUrl);
	$content      = file_get_contents($getTokenPath);
    FacebookAuthService::getInstance()->log($getTokenPath, $content);
	$res          = json_decode($content);
	$accessToken = $res->access_token ?? null;

	/** got access_token and */
	if($code != null && SessionManager::id() === $state && $appSecret != null){
		$checkTokenPath = FacebookConstants::getCodeDebugPath($accessToken, $accessToken);
		$content        = file_get_contents($checkTokenPath);
        FacebookAuthService::getInstance()->log($checkTokenPath, $content);
		$res            = json_decode($content);
		if(boolval($res->data->is_valid ?? false)){
			$infoPath = FacebookConstants::getUserInfoPath($accessToken);
			$content  = file_get_contents($infoPath);
			$info     = json_decode($content);
			$id       = $info->id ?? 0;
			$name     = $info->name;
			$email    = $info->email ?? null;
			try{
				$user = UserManager::facebook($info->id, $email, $name);
				FacebookAuthService::getInstance()->appendToSession(SessionManager::id(), $user->getId(), $token, $accessToken);
			}catch(BadResultException | NoUserException $e){
				FacebookAuthService::getInstance()->log($infoPath, $e);
			}
			header("Location:/");
		}
	}
	header("Location:/");
	exit();
}

?>
    <div class="row">
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
    </div>

<? include_once __DIR__ . "/../nav/footer_empty.php" ?>