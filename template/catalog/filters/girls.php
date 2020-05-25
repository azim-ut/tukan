<?php


$tr = Translate::getInstance();
$brands = ContextDto::getInstance()->propArray("brands");
$height = Catalog::getInstance()->heights();
?>
<div class="align-center" style="background: #f9f9f9; border-top: #eaeaea 1px solid;">
<div class="container">
    <div class="row padding-top-15 padding-bottom-15">

        <div class="col-sm-2 padding-bottom-0">
            <a href="/catalog/boys" class="genderBtn girls">
                <button type="button"></button>
            </a>
        </div>
        <div class="col-sm-5 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 70px;"
                      id="basic-addon1"><?=$tr->get("HEIGHT")?></span>

                <select class="form-control" ng-model="heightTemp" ng-change="updateFilter(heightTemp, brandTemp)">
                    <option ng-value="0"><?=$tr->get("ALL")?></option>
                    <? foreach($height as $row){ ?>
                        <option ng-value="<?=$row->val?>">
                            <?=$row->name?>
                        </option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-5 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 7   0px;"
                      id="basic-addon1">
                    <?=$tr->get("BRAND")?>
                </span>
                <select class="form-control" ng-model="brandTemp" ng-change="updateFilter(heightTemp, brandTemp)">
                    <option ng-value="'All'">-</option>
                    <?
                    foreach($brands as $i => $brand){
                        ?>
                        <option ng-value="'<?=$brand?>'"><?=$brand?></option>
                    <? } ?>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
