<? use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\FileManager;
use core\manager\ParamsManager;
use core\manager\SessionManager;
use core\manager\UserManager;
use core\service\App;
use core\service\FacebookAuthService;

include_once __DIR__ . "/../nav/start_empty.php" ?>
<?
$user = UserManager::current();
FacebookAuthService::getInstance()->log("income", ParamsManager::paramsToString(), 0);
$code      = ParamsManager::getParam("code");
$state     = ParamsManager::getParam("state");
$token     = ParamsManager::getParam("token");
$tokenType = ParamsManager::getParam("token_type");
$expiresIn = ParamsManager::getParam("expires_in");


/** got code, but still has no access_token */
if(!$user && $state === SessionManager::id() && $code != null){

	$getTokenPath = FacebookConstants::changeCodeToAccessTokenPath($code);
	$content      = file_get_contents($getTokenPath);
	FacebookAuthService::getInstance()->log($getTokenPath, $content, 1);
	$res         = json_decode($content);
	$accessToken = $res->access_token ?? null;

	/** got access_token and */
	if($code != null && SessionManager::id() === $state){
		$app_token      = "EAAGipka04bgBAHASuftyl5pcMvT5r92qtBgCoZBRWenWslhAN4WyyQTKox8vqVKilcruoZCytCSn9BpbgJZBJSnPGrBz9CLFmcTS72hRq1vtvvgv9qNAOwzw5eOZA8b9z1QTNcbEM027dWS3ZBZAENSc8YypnMc4AespE5k7sZBcgZDZD";
		$checkTokenPath = FacebookConstants::getCodeDebugPath($accessToken, $app_token);
		$content        = file_get_contents($checkTokenPath);
		FacebookAuthService::getInstance()->log($checkTokenPath, $content, 2);
		$res = json_decode($content);
		if(boolval($res->data->is_valid ?? false)){
			$infoPath = FacebookConstants::getUserInfoPath($accessToken);
			$content  = file_get_contents($infoPath);
			FacebookAuthService::getInstance()->log($infoPath, $content, 3);
			$info     = json_decode($content);
			$id       = $info->id ?? 0;
			$name     = $info->name;
			$email    = $info->email ?? null;
			$icon     = $info->picture->data->url ?? null;
			$iconPath = null;
			try{
				if($icon){
					$dir = __DIR__ . App::context()->settingsByName("avatar.images.dir");
					FileManager::loadFile($icon, $dir . $info->id . ".jpg");
					$iconPath = App::context()->settingsByName("avatar.images.url").$info->id . ".jpg";
                }
				$user = UserManager::facebook($info->id, $email, $name, $iconPath);
				FacebookAuthService::getInstance()->appendToSession(SessionManager::id(), $user->getId(), $token, $accessToken);
			}catch(BadResultException | NoUserException $e){
				FacebookAuthService::getInstance()->log($infoPath, $e->getMessage() . "\n" . $e->getTraceAsString(), 4);
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