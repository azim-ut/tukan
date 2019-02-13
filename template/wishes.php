<? include_once __DIR__ . "/nav/start.php" ?>

    <div ng-controller="WishesListController">
        <div class="WishList text-center">
            <div class="block info" style="position: relative;">
                <div style="height: 90px;">
                    <a href="tel:+37258185225" style="font-size: 100%;">
                        <button class="btn btn-lg btn-icon-only btn-block">
                            <i class="icon-call-out"></i>
                        </button>
                    </a>
                </div>
                <div style="height: 110px; font-size: 140%; font-weight: 700;" class="text-center">
                    Закажите доставку сегодня.
                </div>
                <div>
                    <a href="//www.facebook.com/groups/1152263238270402/">
                        <button class="btn btn-circle btn-block btn-lg facebook-button">
                            <i class="icon-social-facebook"></i>
                        </button>
                    </a>
                </div>
            </div>

            <div ng-repeat="row in data.wishes.list" class="col-sm-4">
                <product-preview id="row.id"
                                 title="row.title"
                                 img="row.img"
                                 price="row.price"
                                 fullprice="row.fullprice"></product-preview>
            </div>
            <div class="block pointer"
                 ng-repeat="row in data.wishes.list"
                 ng-if="data.wishes.indexOf(row.id)>=0">
                <div style="width : 100px;">
                    <button class="btn btn-danger del" ng-click="removeFromList(row.id)">x</button>
                </div>
                <div class="img"
                     ng-click="toProduct(row.name)"
                     style="background-image: url(/wp-content/uploads/auto/{{row.img}}_200x200.jpg);">
                    &nbsp;
                </div>
                <div class="title text-left" ng-click="toProduct(row.name)">
                    {{row.title}}
                </div>
                <div style="width : 100px;" class="price text-left" ng-click="toProduct(row.name)">
                    <s>&nbsp;€ {{row.fullprice}}&nbsp;</s>
                    <span>€ {{row.price}}</span>
                </div>
            </div>
        </div>

    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>