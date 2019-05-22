<? include_once __DIR__ . "/nav/start.php" ?>
    <div style="overflow: hidden;">
        <div ng-controller="CartListController">
            <div class="CartList text-center">
                <div ng-repeat="row in data.cart.list" class="col-sm-4">
                    <product-preview id="row.id"
                                     title="row.title"
                                     img="row.img"
                                     price="row.price"
                                     fullprice="row.fullprice"></product-preview>
                </div>
                <div class="block pointer"
                     ng-repeat="row in data.cart.list"
                     ng-if="data.cart.indexOf(row.id)>=0">
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
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>