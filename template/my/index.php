<?

$ts = Translate::getInstance();
include_once __DIR__ . "/../nav/start.php";

?>
    <script type="text/javascript" src="/web/js/controller/my_index.js"></script>
    <div ng-controller="MySummaryController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <? require_once "menu.php" ?>
                </div>

                <div class="col-sm-7 padding-left-15" style="padding: 20px;">
                    <div class="MyBarHead">
                        <img ng-src="{{data.user.icon}}">
                        <div class="name"><?=$ts->get("HELLO")?>, {{data.user.name}}!</div>
                    </div>

                    <div class="row grid2 margin-top-15">
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">{{summary.total}}</div>
                            <?=$ts->get("ALL_ORDERS")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">{{summary.checkouted}}</div>
                            <?=$ts->get("ORDERS_PROCESSING")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">{{summary.pack}}</div>
                            <?=$ts->get("ORDERS_PACKAGING")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">{{summary.sent}}</div>
                            <?=$ts->get("ORDER_SENT")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">{{summary.delivered}}</div>
                            <?=$ts->get("ORDER_DELIVERED")?>
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">{{summary.claim}}</div>
                            <?=$ts->get("OPEN_DISPUTES")?>
                        </div>
                    </div>

                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>