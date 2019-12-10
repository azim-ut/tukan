<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/cart_empty.css?t=<?=$version?>"/>
<!--    <script src="/web/js/every_pay.js?t=--><?//=$version?><!--" type="text/javascript"></script>-->
    <script src="/web/js/addresses.js?t=<?=$version?>" type="text/javascript"></script>

    <div ng-controller="CartListController"
         ng-cloak
         class="nasa-single-product-scroll HeadContentPage"
         style="padding-right: 20px; padding-left: 20px; background: linear-gradient(#e5e8ed, #a1b3c1);">
        <div ng-if="!cart || cart.items.length == 0" style="text-align: center;">
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
                <div class="gb_Rd_sm overflow-h">
                    <cart-row ng-repeat="row in cart.items" cart="cart" product="row"></cart-row>
                </div>
                <br/>
            </div>
            <div class="col-sm-4">

                <div class="text-right addressBlock gb_Rd_sm">
                    <span style="float: left;">Товары</span>
                    <span class="text-right">x {{cart.items.length}}</span>
                </div>
                <br/>
                <div style="border-top: #eaeaea 1px solid;" class="addressBlock gb_Rd_sm" ng-if="data.user">
                    <div style="line-height: 35px;">Адрес доставки:</div>
                    <div class="text-center center center-block"
                         style="border-top: #ccc 1px solid; overflow: hidden; text-align: center;">
                        <div class="addressBlock"
                             style="position: relative;"
                             ng-if="cart.addr === row.id"
                             ng-repeat="row in cart.addresses track by $index">
                            <div class="btn btn-xs btn-icon-only"
                                 style="position: absolute; right: 0; top: 0; color: #ccc;"
                                 ng-click="showAddressEditForm(row)">
                                <i class="fa fa-edit"></i>
                            </div>
                            <p style="padding: 0 30px;">{{row.data}}</p>
                        </div>

                        <div class="btn-group btn-group-sm btn-block margin-top-10 carAddressList">
                            <button type="button"
                                    ng-class="{'btn btn-icon-only':true, 'active': (cart.addr === row.id)}"
                                    ng-repeat="row in cart.addresses track by $index"
                                    ng-click="useAddress(row.id)">
                                <i class="fa fa-address-card" style="border: none;"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-icon-only"
                                    ng-click="showNewAddressForm()">
                                <i class="fa fa-plus" style="border: none;"></i>
                            </button>
                            </ul>
                        </div>
                    </div>

                </div>
                <br/>
                <div class="text-right addressBlock gb_Rd_sm margin-bottom-20" ng-if="cart.coupons.length>0 && false">
                    <div class="container margin-bottom-15">
                        <div class="row">
                            <div class="col-10 text-left">Купон скидок</div>
                            <div class="col-2 text-right pointer"
                                 ng-if="cart.coupons.length>1"
                                 ng-click="skipCoupon()"><i class="icon icon-arrow-right"></i></div>
                        </div>
                    </div>

                    <div>
                        <div ng-repeat="row in cart.coupons">
                            <couponmini data="row"></couponmini>
                        </div>
                    </div>
                </div>

                <div class="text-right addressBlock gb_Rd_sm"
                     style="font-weight: bold; line-height: 50px; font-size: 130%;">
                    <span style="float: left;">Итого</span>
                    <span class="text-right">€ {{cart.totalPrice}}</span>
                </div>

                <br/>

                <div ng-show="msg" class="msg">{{msg}}</div>
                <div ng-if="data.user">
                    <form action="/pay/everypay" target="iframe-payment-container" method="POST" name="cartSubmit">
                        <button class="btn btn-block btn-primary gb_Rd_sm" type="button" ng-click="checkout()">
                            <i class="fa fa-credit-card"></i> Оплатить
                        </button>
                    </form>
                </div>
                <div ng-if="!data.user">
                    <button class="btn btn-block btn-primary gb_Rd_sm"
                            type="button"
                            data-toggle="modal"
                            ng-if="!data.user"
                            data-target="#AuthForm">
                        Регистрация / Вход
                    </button>
                </div>
            </div>
            <div class="col-xs-1">
                &nbsp;
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="PayForm">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <iframe id="iframe-payment-container" name="iframe-payment-container"
                                width="100%"
                                height="400"
                                style="border: none; height: 450px;width: 100%;overflow-x: hidden;"
                                sandbox="allow-top-navigation allow-forms allow-popups allow-scripts allow-same-origin"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" role="dialog" id="CartCheckouted">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <b>TukanStore OU</b>
                            <table class="table">
                                <tr ng-repeat="row in cart.items">
                                    <td class="text-left">{{row.title}}&nbsp;x&nbsp;{{row.cnt}}</td>
                                    <td width="1%" class="text-nowrap">&euro; {{row.price*row.cnt}}</td>
                                </tr>
                                <tr>
                                    <th class="text-left"><i class="fa fa-tshirt"></i> x {{cart.totalCount}}</th>
                                    <th class="text-nowrap">&euro; {{cart.totalPrice}}</th>
                                    </th>
                            </table>
                            <div class="thin-font">Спасибо за покупку!</div>
                            <br/>
                            <div class="thin-font">Заказ можно отслеживать в вашем кабинете.</div>
                            <br/>
                            <a href="/my">
                                <button type="button" class="btn btn-outline-info btn-block"><i
                                            class="fa fa-user-circle"></i>&nbsp;
                                    Мой кабинет
                                </button>
                            </a>
                            <br/>
                            <button type="button" class="btn btn-outline-info btn-block"><i class="fa fa-close"></i>&nbsp;
                                Закрыть
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="iframe-payment-container" style="display: none; border: 0px; min-width: 460px; min-height: 325px">
            <iframe width="460" height="325" style="border: 0px; height: 325; width: 460"></iframe>
        </div>

    </div>

<? include_once __DIR__ . "/forms/address.php" ?>

<? include_once __DIR__ . "/nav/footer.php" ?>