<? include_once __DIR__ . "/../nav/start.php" ?>
    <script lang="js" src="/web/js/ring.js?t=<?=$version?>"></script>
    <link rel="stylesheet" type="text/css" href="/web/css/ring.css?t=<?=$version?>"/>
    <div ng-controller="RingController" ng-init="init()" style="height: 100vh;" ng-cloak>
        <div class="container" ng-if="!data.user">
            <div class="row">
                <div class="col-sm-4">
                    &nbsp;
                </div>
                <div class="col-sm-4 parcelColumn">
                    <a href="/">
                        <div style="background: transparent url(/web/img/tukan_valga.png) no-repeat center center/contain; width: 100%; height: 100px;"></div>
                    </a>
                    <hr/>
                    Здравствуйте!
                    <hr/>
                    <br/>
                    <i class="fa fa-arrow-down"></i>
                </div>
                <div class="col-sm-4 text-center">
                    &nbsp;Пожалуйста, зарегистрируйтесь:
                    <br/>
                    <br/>
                    <div ng-if="!data.user.icon">{{data.user.name.charAt(0)}}</div>
                </div>
                <div class="col-12">
                    <button type="button"
                            ng-click="loginFB()"
                            class="btn btn-default btn-block btn-primary pointer">
                        <i class="icon-social-facebook"></i> Facebook вход
                    </button>
                </div>
            </div>
        </div>
        <div class="container" ng-if="data.user">
            <div class="row">
                <div class="col-sm-4">
                    &nbsp;
                </div>
                <div class="col-sm-4 parcelColumn">
                    <a href="/">
                        <div style="background: transparent url(/web/img/tukan_valga.png) no-repeat center center/contain; width: 100%; height: 60px;"></div>
                    </a>

                    <div style="margin: 10px 0; font-size: 100%; border: rgba(255,255,255,.5) 1px solid; border-radius: 20px; padding: 5px; ">Ваш текущий бонус:<span style="color: #00ff00;"> {{bonus.coupon}}</span></div>

                    <p style="font-size: 90%;">Нажмите чтобы получить бонус от покупки!</p>
                    
                    <div style="display: flex; text-align: center; justify-content: center;">
                        <div class="imageIcon"
                             ng-if="data.user.icon"
                             ng-style="{'background': 'transparent url('+data.user.icon+') no-repeat center center/contain', 'width':60, 'height':60}">
                        </div>
                    </div>
                    <br/>
                    <i class="fa fa-arrow-down"></i>
                </div>
                <div class="col-sm-4">
                    &nbsp;
                </div>
                <div class="col-12">
                </div>
            </div>
            <div class="serviceBell" ng-if="data.user" ng-click="ring()"></div>
        </div>
    </div>
<? include_once __DIR__ . "/../nav/footer.php" ?>