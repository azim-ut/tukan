<?


$tr = Translate::getInstance();
?>
<? include_once __DIR__ . "/../nav/start.php" ?>

    <div id="content" class="HeadTextPage container" ng-init="contents = []">
        <div class="row">
            <div>
                <h1><?=$tr->get("RULES_TITLE")?></h1>
                <div class="ContentsList">
                    <ul style="list-style: none;">
                        <a href="{{row.href}}" ng-repeat="row in contents">
                            <li style="text-decoration: underline;">{{row.ttl}}</li>
                        </a>
                    </ul>
                </div>

                <a id="order">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'<?=$tr->get("ORDERING_GOODS")?>', href:'#order'})">
                    <?=$tr->get("ORDERING_GOODS")?> <a href="#!#top" style="color: #ccc;">[<?=$tr->get("UP")?>]</a>
                </h2>
                <p>
                    <?=$tr->get("RULES_CHOOSE_PRODUCT")?>
                </p>
                <p>
                    <?=$tr->get("RULES_CHOOSE_PAYMENT")?>
                </p>
                <p>
                    <?=$tr->get("RULES_BUY_PRODUCT")?>
                </p>

                <a id="delivery">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'<?=$tr->get("DELIVERY")?>', href:'#delivery'})"><?=$tr->get("DELIVERY")?>
                    <a href="#!#top" style="color: #ccc;">[<?=$tr->get("UP")?>]</a>
                </h2>
                <p>
                    <?=$tr->get("RULES_POINT_ADDRESS")?>
                </p>
                <p>
                    <?=$tr->get("RULES_ORDER_SENDING")?>
                </p>

                <a id="pay">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'<?=$tr->get("PAYMENT")?>', href:'#pay'})"><?=$tr->get("PAYMENT")?>
                    <a href="#!#top" style="color: #ccc;">[<?=$tr->get("UP")?>]</a>
                </h2>
                <p>
                    <?=$tr->get("RULES_HOW_TO_PAY")?>
                </p>
                <p>
                    <?=$tr->get("RULES_POINT_DEAL_ID")?>
                </p>
                <p>
                    <?=$tr->get("RULES_PAY_CASH")?>
                </p>

                <a id="moneyback">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'<?=$tr->get("RETURNS")?>', href:'#moneyback'})"><?=$tr->get("RETURNS")?>
                    <a href="#!#top" style="color: #ccc;">[<?=$tr->get("UP")?>]</a></h2>
                <p>
                    <?=$tr->get("RULES_RETURN_14_DAYS")?>
                </p>
                <p>
                    <?=$tr->get("RULES_RETURN_BREAK_DEAL")?>
                </p>
                <p>
                    <?=$tr->get("RULES_RETURN_NOTIFY")?>
                </p>
                <p>
                    <?=$tr->get("RULES_RETURN_7_DAYS")?>
                </p>
                <br/>
                <br/>
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/../nav/footer.php" ?>