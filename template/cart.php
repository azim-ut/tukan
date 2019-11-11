<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/cart_empty.css?t=<?=$version?>"/>

    <div ng-controller="CartListController" ng-cloak class="nasa-single-product-scroll HeadContentPage">
        <div ng-if="cart.items.length == 0" style="text-align: center;">
            <div class="emptyCart">
                <div class="example">
                    <b class="icon icon-basket"></b>
                    Корзина пуста
                </div>
            </div>
        </div>

        <div class="row" ng-if="cart.items.length">
            <div class="col-sm-1">
                &nbsp;
            </div>


            <div class="col-sm-5">
                <div style="overflow: hidden; border: #ccc 1px solid;">
                    <cart-row ng-repeat="row in cart.items" cart="cart" product="row"></cart-row>
                </div>
                <br/>
            </div>
            <div class="col-sm-4">

                <div class="text-right" style="line-height: 50px;">
                    <span style="float: left;">Товары</span>
                    <span class="text-right">x {{cart.items.length}}</span>
                </div>

                <div style="border-top: #eaeaea 1px solid;">
                    <div style="line-height: 35px;">Адрес доставки:</div>
                    <div class="text-center center center-block"
                         style="overflow: hidden; text-align: center;">

                        <div class="addressBlock"
                             ng-repeat=" row in cart.address track by $index"
                             ng-if="$index == selectAddress && editAddress === undefined">
                            <p>{{row.data}}</p>
                            <div class="btn btn-xs btn-outline-success btn-block"
                                 ng-click="showAddressEditForm(row)">
                                Редактировать
                            </div>
                        </div>

                        <div class="addressBlock" ng-if="selectAddress === undefined">
                                            <textarea style="width: 100%; height: 90px; line-height: normal;"
                                                      placeholder="Адрес доставки и телефон для связи:"
                                                      ng-model="newAddress"></textarea>
                            <div class="btn btn-xs btn-outline-success btn-block"
                                 ng-click="setAddress(0, newAddress)">Добавить адрес
                            </div>
                        </div>
                        <div class="addressBlock" ng-if="editAddress !== undefined">
                                            <textarea style="width: 100%; height: 90px; line-height: normal;"
                                                      placeholder="Адрес доставки и телефон для связи:"
                                                      ng-model="editAddress.data"></textarea>
                            <div class="btn btn-xs btn-outline-success btn-block"
                                 ng-click="setAddress(editAddress.id, editAddress.data)">Сохранить адрес
                            </div>
                        </div>
                        <div class="btn-group margin-top-10" ng-if="cart.address.length > 0">
                            <button type="button"
                                    ng-class="{'btn btn-outline-success btn-icon-only':true, 'active': selectAddress === $index}"
                                    ng-repeat="row in cart.address track by $index"
                                    ng-click="useAddress($index)">
                                <i class="fa fa-address-card" style="border: none;"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-outline-success btn-icon-only"
                                    ng-click="needNewAddress()">
                                <i class="fa fa-plus" style="border: none;"></i>
                            </button>
                            </ul>
                        </div>
                    </div>

                    <hr style="border: none;border-top: #eaeaea 1px solid;margin: 20px 0 0;"/>
                    <div class="text-right"
                         style="font-weight: bold; line-height: 50px; font-size: 130%;">
                        <span style="float: left;">Итого</span>
                        <span class="text-right">€ {{cart.totalPrice}}</span>
                    </div>
                </div>


                &nbsp;

                <div ng-show="msg" class="msg">{{msg}}</div>
                <button class="btn btn-block btn-primary" ng-click="submit(cart)">
                    <i class="fa fa-credit-card"></i>
                    Оплатить
                </button>

            </div>
            <div class="col-xs-1">
                &nbsp;
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>