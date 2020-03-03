<?
include_once __DIR__ . "/../nav/start.php";

?>
    <script type="text/javascript" src="/web/js/controller/my_coupons.js"></script>
    <div ng-cloak class="HeadContentPage" ng-controller="MyCouponsController">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <? require_once "menu.php" ?>
                </div>


                <div class="col-sm-7 padding-left-15" style="padding: 20px;">
                    <div class="col-12" ng-repeat="row in list">
                        <coupon data='row'></coupon>
                    </div>
                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>