<? include_once __DIR__ . "/nav/start.php" ?>
    <div class="row" ng-controller="CartListController">
        <div class="col-md-1">
            &nbsp;
        </div>
            <div class="col-md-7" style="
                                        overflow: hidden;
                                        padding: 0;
                                        border: #ccc 2px solid;">
            <div class="row" ng-repeat="row in data.cart.items"
                 style="margin: 0; border-bottom: #ccc 1px solid; background: #fff; padding: 10px;">
                <div class="col-xs-2"
                     style="width: 80px; height: 80px; border: #eaeaea 2px solid; background: #fff url('/wp-content/uploads/auto/{{row.img}}_200x200.jpg') no-repeat center center/cover">
                    &nbsp;
                </div>
                <div class="col-xs-8">
                    <table style="width: 100%;">
                        <tr>
                            <td rowspan="2">{{row.title}}</td>
                            <td class="text-center" style="width: 1%;">
                                <i class="icon-trash" style="font-weight: bolder;"></i>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" style="width: 1%;">
                                <i class="icon-heart" style="font-weight: bolder;"></i>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-xs-2 text-right">
                    <div style="white-space: nowrap;">€ {{row.price}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-sm-12"
                     style="overflow: hidden;
                            background: #fff;
                            border: #ccc 2px solid;">

                    <div class="text-right" style="line-height: 50px;">
                        <span style="float: left;">Товары</span>
                        <span class="text-right">x {{data.cart.items.length}}</span>
                    </div>

                    <div style="line-height: 50px;">
                        <div>Адрес доставки:</div>
                        <p>{{data.cart.address}}</p>
                    </div>

                    <hr style="border-bottom: #ccc 1px solid; border-top: #333 1px solid; margin: 20px 0 0;"/>
                    <div class="text-right" style="font-weight: bold; line-height: 50px; font-size: 130%;">
                        <span style="float: left;">Итого</span>
                        <span class="text-right">€ {{data.cart.sum}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">
        </div>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>