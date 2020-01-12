<? include_once __DIR__ . "/nav/start.php" ?>
    <link rel="stylesheet" type="text/css" href="/web/css/modern.css?t=<?=$version?>"/>
    <div ng-controller="ModernLandingController" ng-init="init()">
        <div class="container" style="margin-top: 20px;margin-bottom: 20px;">
            <div class="row">
                <div class="col-12">
                </div>
                <div class="col-4 parcelColumn">
                    <div style="background: transparent url(/web/img/tukan_valga.png) no-repeat 0 center/contain; width: 170px; height: 80px;"></div>
                </div>
                <div class="col-4 parcelColumn">
                    <div style="background: transparent url(/web/img/tukan_valga.png) no-repeat 0 center/contain; width: 170px; height: 80px;"></div>
                </div>
                <div class="col-4">
                    <div class="townSelect">
                        <div class="townInput">
                            <div class="logos">
                                <div class="itella"></div>
                            </div>
                            <input type="text" class="form-control" ng-model="searchText">
                        </div>
                        <div class="townList">
                            <div class="town"
                                 ng-if="!searchPlace || searchPlace === '' || searchPlace(place.search)"
                                 ng-repeat="place in places track by $index">
                                <div class="name">{{place.name}}</div>
                                <div class="location">
                                    <div class="twn" ng-if="place.city !== ''">{{place.city}},</div>
                                    <div class="addr">{{place.addr}}</div>
                                </div>
                            </div>
                            <div class="force-overflow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                if (!$.browser.webkit) {
                    $('.wrapper').html('<p>Sorry! Non webkit users. :(</p>');
                }
            });
        </script>
    </div>
<? include_once __DIR__ . "/nav/footer.php" ?>