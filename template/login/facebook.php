<? use core\service\FacebookAuthService;

include_once __DIR__ . "/../nav/start_empty.php" ?>
<?
FacebookAuthService::getInstance()->log($_GET);
?>
<div class="row">
    <div class="col-xs-2">&nbsp;</div>
    <div class="col-xs-2">&nbsp;</div>
    <div class="col-xs-2">&nbsp;</div>
</div>

<? include_once __DIR__ . "/../nav/footer_empty.php" ?>