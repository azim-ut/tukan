<?php
require_once(__DIR__ . "/config.php");

require_once("nav/head.php");
?>


<div ng-controller="PresetsController" ng-init="fetchList();">

    <div class="btn-group btn-group-justified" role="group">
        <div class="btn-group">
            <a href="/assets" class="btn btn-default">
                <i class="glyphicon glyphicon-home"></i>
            </a>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#NewPresetForm">New Preset
            </button>
        </div>
    </div>
    <div>
        <table class="table table-striped table-hover">
            <tr ng-repeat="row in list">
                <td>&nbsp;</td>
                <td>{{row.text}}</td>
                <td width="60px">
                    <button type="button" class="btn btn-warning"
                            data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus
sagittis lacus vel augue laoreet rutrum faucibus."
                            data-clipboard-text="{{row.text}}">
                        <i class="glyphicon glyphicon-copy"></i>
                    </button>
                </td>
                <td width="60px">
                    <button type="button" class="btn btn-info" ng-click="showEditForm(row)">
                        <i class="glyphicon glyphicon-edit"></i>
                    </button>
                </td>
                <td width="60px">
                    <button type="button" class="btn btn-danger" ng-click="removePreset(row)"><i
                                class="glyphicon glyphicon-remove"></i></button>
                </td>
            </tr>
        </table>
    </div>

    <br/>


    <div class="modal fade" id="EditPresetForm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form ng-submit="editPreset(edit.id, edit.text, edit.sort)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактировать пресет</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Текст</label>
                            <textarea class="form-control" ng-model="edit.text" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="NewPresetForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form ng-submit="createPreset(newText)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Новый пресет</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Текст</label>
                            <textarea class="form-control" ng-model="newText" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</body>
</html>