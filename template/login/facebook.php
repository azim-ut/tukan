<?

include_once __DIR__ . "/../nav/start_empty.php" ?>
<?
$code        = $_GET["code"]??null;
$state       = $_GET["state"]??null;
$token       = $_GET["token"]??null;
$tokenType   = $_GET["token_type"]??null;
$expiresIn   = $_GET["expires_in"]??null;
$redirectUrl = Facebook::getInstance()->login($code, $state, $token, $tokenType, $expiresIn);
var_dump($redirectUrl);
if($redirectUrl != null){
    header("Location:" . $redirectUrl);
}
?>
    <div class="row">
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
        <div class="col-xs-2">&nbsp;</div>
    </div>

<? include_once __DIR__ . "/../nav/footer_empty.php" ?>