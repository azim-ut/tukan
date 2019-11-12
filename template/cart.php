<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/cart_empty.css?t=<?=$version?>"/>

    <div ng-controller="CartListController" ng-cloak class="nasa-single-product-scroll HeadContentPage" style="padding-right: 20px; padding-left: 20px; background: linear-gradient(#e5e8ed, #a1b3c1);">
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


            <div class="col-sm-5" style="border-right: #ccc 1px solid;">
                <div style="overflow: hidden; border: #ccc 1px solid;">
                    <cart-row ng-repeat="row in cart.items" cart="cart" product="row"></cart-row>
                </div>
                <br/>
            </div>
            <div class="col-sm-4">

                <div class="text-right addressBlock">
                    <span style="float: left;">Товары</span>
                    <span class="text-right">x {{cart.items.length}}</span>
                </div>
                <br/>
                <div style="border-top: #eaeaea 1px solid;" class="addressBlock">
                    <div style="line-height: 35px;">Адрес доставки:</div>
                    <div class="text-center center center-block"
                         style="overflow: hidden; text-align: center;">

                        <div class="addressBlock"
                             style="position: relative;"
                             ng-repeat=" row in cart.address track by $index"
                             ng-if="$index == selectAddress && editAddress === undefined">
                            <p>{{row.data}}</p>
                            <div class="btn btn-xs btn-icon-only"
                                 style="position: absolute; right: 0; top: 0; color: #ccc;"
                                 ng-click="showAddressEditForm(row)">
                                <i class="fa fa-edit"></i>
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
                        <div class="addressBlock" ng-if="editAddress !== undefined" style="position: relative;">
                                            <textarea style="width: 100%; height: 90px; line-height: normal;"
                                                      placeholder="Адрес доставки и телефон для связи:"
                                                      ng-model="editAddress.data"></textarea>
                            <div class="btn-block btn-group">
                                <div class="btn btn-xs btn-outline-success btn-block"
                                     ng-click="setAddress(editAddress.id, editAddress.data)">
                                    <i class="fa fa-save"></i> Сохранить
                                </div>
                            </div>
                            <div class="btn btn-xs btn-icon-only"
                                 style="position: absolute; right: 0; top: 0;"
                                 ng-click="closeEditAddress()">
                                <i class="fa fa-close"></i>
                            </div>
                        </div>
                        <div class="btn-group btn-group-sm btn-block margin-top-10" ng-if="cart.address.length > 0">
                            <button type="button"
                                    ng-class="{'btn btn-icon-only':true, 'active': selectAddress === $index}"
                                    ng-repeat="row in cart.address track by $index"
                                    ng-click="useAddress($index)">
                                <i class="fa fa-address-card" style="border: none;"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-icon-only"
                                    ng-click="needNewAddress()">
                                <i class="fa fa-plus" style="border: none;"></i>
                            </button>
                            </ul>
                        </div>
                    </div>

                </div>

                <br/>
                <div class="text-right addressBlock"
                     style="font-weight: bold; line-height: 50px; font-size: 130%;">
                    <span style="float: left;">Итого</span>
                    <span class="text-right">€ {{cart.totalPrice}}</span>
                </div>

                <br/>

                <div ng-show="msg" class="msg">{{msg}}</div>
                <button class="btn btn-block btn-primary" ng-click="submit(cart)">
                    <i class="fa fa-credit-card"></i> Оплатить
                </button>

            </div>
            <div class="col-xs-1">
                &nbsp;
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>