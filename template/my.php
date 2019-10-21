<? use core\manager\UserManager;

include_once __DIR__ . "/nav/start.php" ?>

<?
$user = UserManager::currentId();
if(!$user){
	header("Locations: /");
	exit();
}
?>
1
	<div ng-controller="AuthBlockController" ng-cloak class="nasa-single-product-scroll" ng-init="check()">

		<div class="row">
			<div class="col-xs-1">
				&nbsp;
			</div>

			<div class="col-xs-3">
				&nbsp;
				<div class="list-group">
					<a ng-click="logout()" class="list-group-item">Logout</a>
				</div>
			</div>


			<div class="col-xs-7 margin-bottom-30">
				{{data.user.name}}
			</div>

			<div class="col-xs-1">
			</div>
		</div>
	</div>
2


<? include_once __DIR__ . "/nav/footer.php" ?>