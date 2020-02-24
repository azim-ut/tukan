<?php

use core\service\App;
use core\service\TranslateService;

$tr = TranslateService::getInstance();

$brands  = preg_split("#,#", App::context()->settingsByName("brands") ?? "");
$height  = [70, 76, 82, 88, 93, 98, 104, 110, 116, 122, 128, 134, 140, 146, 152];
$genders = [0 => $tr->get("FOR_CHILDREN"), 1 => $tr->get("FOR_BOYS"), 2 => $tr->get("FOR_GIRLS")];
?>
<div class="align-center" style="background: #f9f9f9; border-top: #eaeaea 1px solid;">
<div class="container">
    <div class="row padding-top-15 padding-bottom-15">

        <div class="col-sm-3 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 70px;"
                      id="basic-addon1"><?=$tr->get("HEIGHT")?></span>
                <select class="form-control" ng-model="heightTemp">
                    <option ng-value="0"><?=$tr->get("ALL")?></option>
                    <? foreach($height as $key => $val){ ?>
                        <option ng-value="<?=$val?>"><?=$val?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 70px;"
                      id="basic-addon1">
                    <?=$tr->get("GENDER")?>
                </span>
                <select class="form-control" ng-model="genderTemp">
                    <? foreach($genders as $key => $val){ ?>
                        <option ng-value="<?=$key?>"><?=$val?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 7   0px;"
                      id="basic-addon1">
                    <?=$tr->get("BRAND")?>
                </span>
                <select class="form-control" ng-model="brandTemp">
                    <?
                    foreach($brands as $i => $brand){
                        ?>
                        <option ng-value="<?=$i?>"><?=$brand?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 padding-bottom-5">
            <button class="btn btn-outline-success btn-block"
                    style="font-size: 100%; letter-spacing: normal;"
                    ng-click="updateFilter(heightTemp, genderTemp, brandTemp)">
                <i class="fa fa-search"></i>

                <?=$tr->get("SHOW")?>
            </button>
        </div>
    </div>
</div>
</div>
