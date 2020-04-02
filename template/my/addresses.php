<?
try{

	$user = UserDto::getInstance()->get();
	if(!$user){
		throw new Exception();
	}
}catch(Exception $e){
	header("Location: /");
	exit();
}
$ts        = Translate::getInstance();
$countries = CountriesDto::getInstance()->list();
include_once __DIR__ . "/../nav/start.php";
?>
    <script type="text/javascript" src="/web/js/addresses.js?t=<?=$version?>"></script>

    <div ng-controller="AddressesBlockController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">

                <div class="col-sm-3 margin-bottom-15">
					<? require_once "menu.php" ?>
                </div>

                <div class="col-sm-9">
                    <button type="button"
                            class="btn btn-success btn-lg"
                            ng-click="openNewAddressForm()"><?=$ts->get("ADD_ADDRESS")?>
                    </button>
                    <hr/>
                    <div class="row">
                        <div class="container">
                            <div class="col-sm-4 addressUserRow" ng-repeat="row in list">
                                <i class="fa fa-user"></i> {{row.name}}<br/>
                                <i class="fa fa-map-marker"></i> {{row.address}}<br/>
                                {{row.town}}, {{row.region}}, {{row.zip}}<br/>
                                {{row.country}}<br/>
                                <br/>
                                <div ng-if="row.phone_code && row.phone_number">
                                    <i class="fa fa-mobile-phone"></i> +{{row.phone_code}} {{row.phone_number}}<br/>
                                </div>
                                <div ng-if="row.phone_code_2 && row.phone_number_2">
                                    <i class="fa fa-mobile-phone"></i> +{{row.phone_code_2}} {{row.phone_number_2}}<br/>
                                </div>
                                <br/>
                                <br/>
                                <div class="tools">
                                    <a ng-click="openEditForm(row)" class="pointer"><?=$ts->get("EDIT")?></a> |
                                    <a ng-click="showAddressDelForm(row.id, row.name)"
                                       class="pointer"><?=$ts->get("DELETE")?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<? include_once __DIR__ . "/../forms/address.php" ?>


<? include_once __DIR__ . "/../nav/footer.php" ?>