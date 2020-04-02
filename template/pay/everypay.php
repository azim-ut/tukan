<?php

$endpoint = EveryPayDto::getInstance()->endPoint();
$data     = EveryPayDto::getInstance()->getInitData();
exit();
?>

<iframe id="iframe-payment-container" name="iframe-payment-container" width="400"
        height="400" sandbox="allow-top-navigation allow-forms allow-popups allow-scripts allow-same-origin"></iframe>
<form action="<?=$endpoint?>" id="iframe_form" method="post"
      style="display: none" target="iframe-payment-container">
	<?
	foreach($data as $key => $val){
		?>
        <input name="<?=$key?>" value="<?=$val?>">
		<?
	}
	?>
</form>

<script>
    window.onload = function () {
        document.getElementById("iframe_form").submit();
    }
</script>