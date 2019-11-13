<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/wishlist_empty.css"/>

    <div class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div ng-controller="WishesListController" class="col-12">
                    <div class="WishList text-center">
                        <div class="emptyWish" ng-if="!data.wishes || !data.wishes.list.length">
                            <div class="example">
                                <b class="icon icon-heart"></b>
                                Wish list is empty
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="border-top: #b9c5c2 1px solid; overflow: hidden; padding: 10px;">
                                <div ng-repeat="row in data.wishes.list"
                                     style="float: left; padding: 10px;"
                                     class="card cardItemPreview">
                                    <a href="/product/{{row.id}}" title="{{row.title}}">
                                        <div style="background: transparent url({{row.img}}) no-repeat center center/contain    ;"
                                             class="card-img-top"></div>
                                    </a>
                                    <div class="card-body card-body-price" style="padding: 0;">
                                        <div class="card-title bold">{{row.title}}</div>
                                        <table width="100%;">
                                            <tr>
                                                <td>
                                                    <div wish-button product="{{row.id}}" title="{{row.title}}" class="left"></div>
                                                </td>
                                                <td align="right">
                                                    <div cart-button product="{{row.id}}" price="{{row.price}}" class="right"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block pointer"
                             ng-repeat="row in data.wishes.list"
                             ng-if="data.wishes.indexOf(row.id)>=0">
                            <div style="width : 100px;">
                                <button class="btn btn-danger del" ng-click="toggleWish(row.id)">x</button>
                            </div>
                            <div class="img"
                                 ng-click="toProduct(row.name)"
                                 style="background-image: url(/wp-content/uploads/auto/{{row.img}}_200x200.jpg);">
                                &nbsp;
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>