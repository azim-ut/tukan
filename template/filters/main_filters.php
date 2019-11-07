<?php

use core\service\App;

$brands  = preg_split("#,#", App::context()->settingsByName("brands") ?? "");
$height  = [70, 76, 82, 88, 93, 98, 104, 110, 116, 122, 128, 134, 140, 146, 152];
$genders = [0 => 'Для мальчиков и девочек', 1 => 'Для мальчиков', 2 => 'Для девочек'];
?>
<div style="text-align: center;">
    <div class="row padding-top-15 padding-bottom-15">

        <div class="col-sm-3 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Рост</span>
                <select class="form-control" ng-model="heightTemp">
                    <option ng-value="0">Все</option>
                    <? foreach($height as $key => $val){ ?>
                        <option ng-value="<?=$val?>"><?=$val?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Пол</span>
                <select class="form-control" ng-model="genderTemp">
                    <? foreach($genders as $key => $val){ ?>
                        <option ng-value="<?=$key?>"><?=$val?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1">Бренд</span>
                <select class="form-control" ng-model="brandTemp">
                    <option ng-value="0">Все</option>
                    <?
                    foreach($brands as $i => $brand){
                        ?>
                        <option ng-value="<?=$i+1?>"><?=$brand?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-3 padding-bottom-5">
            <button class="btn btn-primary btn-group-justified"
                    style="font-size: 100%; letter-spacing: normal;"
                    ng-click="updateFilter(heightTemp, genderTemp, brandTemp)">
                <i class="glyphicon glyphicon-search"></i> Показать
            </button>
        </div>
    </div>
</div>
