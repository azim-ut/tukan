<? include_once __DIR__ . "/nav/start.php" ?>
    <link type="text/css" rel="stylesheet" href="/web/css/wishlist_empty.css"/>

    <div class="HeadContentPage">
        <div class="row">
            <div ng-controller="WishesListController" class="col-12">
                <div class="WishList text-center">

                    <div class="emptyWish" ng-if="!data.wishes || !data.wishes.list.length">
                        <div class="example">
                            <b class="icon icon-heart"></b>
                            Wish list is empty
                        </div>
                    </div>
                    <div class="row" style="border-top: #b9c5c2 1px solid; overflow: hidden;">
                        <div ng-repeat="row in data.wishes.list" class="col-6 col-sm-3 productPreview" style="padding: 0;">
                            <product-preview id="row.id"
                                             title="row.title"
                                             img="row.img"
                                             price="row.price"
                                             fullprice="row.fullprice"></product-preview>
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
<? include_once __DIR__ . "/nav/footer.php" ?>