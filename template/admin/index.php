<?php

use assets\services\CatalogService;
use assets\services\TagsService;

$catalog     = CatalogService::getInstance();
$tagsService = TagsService::getInstance();
$list        = $catalog->getList();
$jsonList    = json_encode($list);
require_once("nav/head.php");
?>
<div ng-controller="AdminIndexController" ng-init="fetchData();">
    <div class="btn-group btn-group-justified" role="group">
        <div class="btn-group">
            <a href="/assets" class="btn btn-default">
                <i class="glyphicon glyphicon-home"></i>
            </a>
        </div>
        <div class="btn-group">
            <a href="/assets/new.php" class="btn btn-default">+</a>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-default" ng-click="changeFilteStatus('draft')" ng-if="status == 'publish'">
                <i class="glyphicon glyphicon-eye-open"></i>
            </button>
            <button type="button" class="btn btn-default" ng-click="changeFilteStatus('publish')" ng-if="status == 'draft'">
                <i class="glyphicon glyphicon-eye-close"></i>
            </button>
        </div>
        <div class="btn-group">
            <a href="/assets/presets.php" class="btn btn-default">
                <i class="glyphicon glyphicon-bullhorn"></i>
            </a>
        </div>
        <div class="btn-group">
            <a href="/assets/seo.php" class="btn btn-default">
                SEO
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
                <button type="button" onclick="location.href='/assets/new.php'" class="btn btn-primary ">+</button>
                <button type="button" class="btn btn-warning">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </button>
                <button type="button" ng-click="changeFilteStatus('publish')" ng-if="status == 'draft'" class="btn btn-warning">
                    <i class="glyphicon glyphicon-eye-close"></i>
                </button>
        </div>
    </div>

    <div>
        <span ng-repeat="row in tags track by $index" style="margin: 2px 5px 0 0;">
            <button type="button"
                    ng-class="{'btn btn-xs':1, 'btn-success':row.on, 'btn-default':!row.on}"
                    ng-click="toggleTag(row)">
                {{row.name}}
            </button>
            <span ng-if="[1,18].indexOf($index)>=0">&nbsp;&nbsp;|||&nbsp;</span>
        </span>
    </div>
    <br/>
    <div class="row">
        <table class="table table-hover table-striped" style="width: 100%;">
            <tr ng-repeat="post in posts">
                <td width="50px"
                    style="height: 50px; background: transparent url({{post.img}}) no-repeat center center/cover">
                    &nbsp;
                </td>
                <td>
                    <a href="/assets/edit.php?id={{post.id}}">{{post.title}}</a>
                    <div>
                        <small>{{post.tags}}</small>
                    </div>
                    <div ng-if="post.content && post.content.length>50">
                        <small>{{post.content | limitTo:50}}...</small>
                    </div>
                </td>
                <td width="60px">
                    <button class="btn btn-block btn-warning" ng-if="post.status == 'publish'" ng-click="togglePublish(post)">
                        <i class="glyphicon glyphicon-eye-open"></i>
                    </button>
                    <button class="btn btn-block btn-warning" ng-if="post.status == 'draft'" ng-click="togglePublish(post)">
                        <i class="glyphicon glyphicon-eye-close"></i>
                    </button>
                </td>
                <td width="60px"><a href="/product/{{post.id}}">
                        <button class="btn btn-block btn-info"><i class="glyphicon glyphicon-link"></i></button>
                    </a></td>
                <td width="60px">
                    <button class="btn btn-block btn-danger" ng-click="checkDel(post.title, post.id)"><i
                                class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
        </table>
    </div>
</div>

