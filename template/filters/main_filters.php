<?php
?>
<div style="text-align: center;">
	<div class="row" style="padding: 0;" id="CatalogFilter">
		<div class="col-xs-2 padding-top-10 arrowPager text-center" ng-click="backList()">
			<span class="bold">&lt;</span>
		</div>

		<div class="col-xs-4 padding-top-15 pagerFilterBlock"
		     style="font-size: 140%;">
			<div class="height tool" ng-click="showFilterModal()">
				<span ng-if="!height">Рост: -</span>
				<span ng-if="height"><span class="toolsTtl">Рост: </span>{{height}}cm</span>
			</div>
		</div>
		<div style="position: fixed; margin-top: -12px; left: 0; right: 0; text-align: center; display: inline-block;">
			<div style="
                    display: inline-block;
                    background: #fff;
                    padding: 2px 5px;
                    font-size: small;
                    border: #ccc 1px solid;
                    class=" text-center
			">
			<span class="bold">c {{offset}} по {{offset + limit}} из {{total}}</span>
		</div>
	</div>
	<div class="col-xs-4 text-right padding-top-10 pagerFilterBlock" style="font-size: 80%; height: 45px;">
		<div class="tool" ng-click="showFilterModal()">
			<div ng-if="gender === 2">Для девочек</div>
			<div ng-if="gender === 1">Для мальчиков</div>
			<div ng-if="gender === 3 || gender === 0">Для мальчиков и девочек</div>
		</div>
	</div>
	<div class="col-xs-2 padding-top-10 arrowPager text-center" ng-click="forwardList()">
		<span class="bold">&gt;</span>
	</div>
</div>
</div>
