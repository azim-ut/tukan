<script async defer crossorigin="anonymous" src="https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v4.0&appId=460310011240888&autoLogAppEvents=1"></script>
<div id="fb-root"></div>

<div ng-controller="AuthBlockController" ng-cloak="" ng-init="check()">


    <div class="modal fade" tabindex="-1" role="dialog" id="AuthForm">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">&nbsp;</h4>
                </div>
                <div class="modal-body">

                    <div ng-if="tab == 'login'">
                        <form ng-submit="login(email, pwd, save)">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password" ng-model="pwd">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-warning btn-group-justified">Вход</button>
                            </div>

                            <div class="form-group overflow">
                                <label for="nasa_rememberme" class="pull-left">
                                    <input ng-model="save" type="checkbox" id="nasa_rememberme" value="forever">
                                    Запомнить меня
                                </label>
                                <a class="small pull-right" ng-click="setTab('forgot')">Забыли пароль?</a>
                            </div>
                        </form>
                        <hr/>
                        <div class="form-group">
                            <div class="fb-login-button" data-width="100%" data-size="medium" data-button-type="continue_with" data-auto-logout-link="true" data-use-continue-as="true"></div>
                        </div>
                        <div class="form-group">
                            <input ng-click="setTab('registration')"
                                   type="button"
                                   value="Регистрация"
                                   class="btn btn-default btn-group-justified">
                        </div>
                    </div>

                    <div ng-if="tab === 'forgot'">
                        <form ng-submit="resetPassword(email)">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-warning btn-group-justified">Выслать новый пароль</button>
                            </div>
                        </form>
                        <hr/>
                        <div class="form-group">
                            <input ng-click="setTab('login')"
                                   type="button"
                                   value="Вход"
                                   class="btn btn-default btn-group-justified">
                        </div>
                    </div>
                    <div id="nasa_customer_login" class="nasa-relative" ng-if="tab == 'registration'">
                        <form ng-submit="register(name, email, pwd1, pwd2, terms)">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-user"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Имя" ng-model="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Пароль" ng-model="pwd1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="glyphicon glyphicon-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Повторите пароль"
                                           ng-model="pwd2">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-warning btn-group-justified">Зарегистрироваться</button>
                            </div>

                        </form>
                        <hr/>
                        <div class="form-group">
                            <input ng-click="setTab('login')"
                                   type="button"
                                   value="Вход"
                                   class="btn btn-default btn-group-justified">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



