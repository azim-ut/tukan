<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/cart_empty.css"/>

    <div ng-controller="CartListController" ng-cloak>
        <div ng-if="data.cart.items.length == 0" style="text-align: center;">
            <div class="emptyCart">
                <div class="example">
                    <b class="icon icon-basket"></b>
                    Cart is empty
                </div>
            </div>
        </div>

        <div class="row" ng-if="data.cart.items.length">
            <div class="col-xs-1">
                &nbsp;
            </div>


            <div class="col-xs-10">
                <div class="row">
                    <div class="col-xs-7">
                        <div style="
                                        overflow: hidden;
                                        padding: 0;
                                        border: #ccc 1px solid;">

                            <cart-row ng-repeat="row in data.cart.items" cart="data.cart" product="row"></cart-row>
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="row">
                            <div class="col-sm-12"
                                 style="overflow: hidden;
                            background: #fff;
                            border: #ccc 1px solid;">

                                <div class="text-right" style="line-height: 50px;">
                                    <span style="float: left;">Товары</span>
                                    <span class="text-right">x {{data.cart.items.length}}</span>
                                </div>

                                <div style="border-top: #eaeaea 1px solid;">
                                    <div style="line-height: 35px;">Доставка:</div>
                                    <textarea style="width: 100%; height: 90px; line-height: normal;"
                                              placeholder="Адрес доставки и телефон для связи:"
                                              ng-model="data.cart.address"></textarea>
                                </div>

                                <hr style="border: none;border-top: #eaeaea 1px solid;margin: 20px 0 0;"/>
                                <div class="text-right" style="font-weight: bold; line-height: 50px; font-size: 130%;">
                                    <span style="float: left;">Итого</span>
                                    <span class="text-right">€ {{data.cart.sum}}</span>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            Доступные способы и время доставки можно уточнить по телефону:
                            <div style="line-height: 30px; font-weight: bold; margin: 10px 0;">
                                (372) 5818 5225
                            </div>

                            <div ng-show="msg" class="msg">{{msg}}</div>
                            <button class="btn cart-page-submit" ng-click="submit()">Заказать</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xs-1">
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>