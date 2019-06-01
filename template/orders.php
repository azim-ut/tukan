<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/cart_empty.css"/>

    <div ng-controller="OrdersListController" ng-cloak class="orders">
        <div ng-if="data.orders.length == 0" style="text-align: center;">
            <div class="emptyCart">
                <div class="example">
                    <b class="icon icon-list"></b>
                    <br/>
                    <br/>
                    <br/>
                    Order list is empty
                </div>
            </div>
        </div>
        <div class="row" ng-if="data.orders.length">
            <div class="col-xs-1">
                &nbsp;
            </div>


            <div class="col-xs-10">
                <div style="
                            overflow: hidden;
                            padding: 0;
                            border: #ccc 1px solid;">
                    <order-row ng-repeat="row in data.orders" order="row"></order-row>
                </div>
            </div>
            <div class="col-xs-1">
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>