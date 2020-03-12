<?

include_once __DIR__ . "/../nav/start_empty.php" ?>
<?
$code        = $_GET["code"];
$state       = $_GET["state"];
$token       = $_GET["token"];
$tokenType   = $_GET["token_type"];
$expiresIn   = $_GET["expires_in"];
$redirectUrl = Facebook::getInstance()->login($code, $state, $token, $tokenType, $expiresIn);
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