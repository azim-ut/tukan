<!DOCTYPE html>
<html lang="ru-RU" ng-app='root'>
<? include_once __DIR__ . "/nav/head.php" ?>
<body style="padding: 0;">
<div ng-controller="TranslateController" ng-init="getAll()">
    <table class="table table-bordered">
        <tr>
            <td>
                <form ng-submit="create(pattern)">
                    <div class="input-group mb-3 margin-bottom-0">
                        <div class="input-group-prepend" ng-click="toggleMode()" ng-style="{'background-color': (mode === 'key')?'#ccc':'#00ff00'}">
                            <span class="input-group-text" style="background: none;" id="basic-addon1" ng-if="mode === 'key'">KEY</span>
                            <span class="input-group-text" style="background: none;" id="basic-addon1" ng-if="mode === 'val'"><b>VAL</b></span>
                        </div>
                        <input type="text" class="form-control" ng-model="pattern">
                        <button class="btn btn-primary"><i class="fa fa-plus"></i></button>
                    </div>
                </form>
            </td>
        </tr>
    </table>

    <form ng-submit="update(row.id, row.en_US, row.ru_RU, row.et_EE)" ng-repeat="row in list"
          ng-if="!pattern || pattern.length ===0 || isFiltered(mode, pattern, row)">
        <div class="row"
             style="border: #ccc 1px solid; padding: 13px 5px 5px; margin: 5px; background: #eaeaea;">
            <div class="col-12">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">RU</span>
                    </div>
                    <input type="text" class="form-control" ng-model="row.ru_RU">
                </div>
            </div>
            <div class="col-12">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">EN</span>
                    </div>
                    <input type="text" class="form-control" ng-model="row.en_US">
                </div>
            </div>
            <div class="col-12">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">EE</span>
                    </div>
                    <input type="text" class="form-control" ng-model="row.et_EE">
                </div>
            </div>
            <div class="col">
                <button type="button"
                        ng-click="delete(row.id, row.code)"
                        class="btn btn-block btn-outline-danger"><i class="fa fa-trash"></i> Удалить
                </button>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-block btn-outline-info"><i class="fa fa-save"></i> Сохранить
                </button>
            </div>
            <small
                ng-click="copyToClipboard($event)"
                style="color: #fff; position: absolute; background: #333; padding: 2px 10px; font-size: 10px; margin-left: 20px; margin-top: -12px;">
                KEY: <b>{{row.code}}</b>
            </small>
        </div>
    </form>

</div>
</body>
</html>
