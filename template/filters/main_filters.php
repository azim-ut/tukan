<?php


$tr = Translate::getInstance();
$brands = ContextDto::getInstance()->propArray("brands");
$height = Catalog::getInstance()->heights();
$genders = [0 => $tr->get("FOR_CHILDREN"), 1 => $tr->get("FOR_BOYS"), 2 => $tr->get("FOR_GIRLS")];
?>
<div class="align-center" style="background: #f9f9f9; border-top: #eaeaea 1px solid;">
<div class="container">
    <div class="row padding-top-15 padding-bottom-15">

        <div class="col-sm-4 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 70px;"
                      id="basic-addon1"><?=$tr->get("HEIGHT")?></span>

                <select class="form-control" ng-model="heightTemp" ng-change="updateFilter(heightTemp, genderTemp, brandTemp)">
                    <option ng-value="0"><?=$tr->get("ALL")?></option>
                    <? foreach($height as $row){ ?>
                        <option ng-value="<?=$row->val?>">
                            <?=$row->name?>
                        </option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 70px;"
                      id="basic-addon1">
                    <?=$tr->get("GENDER")?>
                </span>
                <select class="form-control" ng-model="genderTemp" ng-change="updateFilter(heightTemp, genderTemp, brandTemp)">
                    <? foreach($genders as $key => $val){ ?>
                        <option ng-value="<?=$key?>"><?=$val?></option>
                    <? } ?>
                </select>
            </div>
        </div>
        <div class="col-sm-4 padding-bottom-5">
            <div class="input-group">
                <span class="input-group-addon input-group-text"
                      style="width: 7   0px;"
                      id="basic-addon1">
                    <?=$tr->get("BRAND")?>
                </span>
                <select class="form-control" ng-model="brandTemp" ng-change="updateFilter(heightTemp, genderTemp, brandTemp)">
                    <?
                    foreach($brands as $i => $brand){
                        ?>
                        <option ng-value="<?=$i?>"><?=$brand?></option>
                    <? } ?>
                </select>
            </div>
        </div>
    </div>
</div>
</div>
