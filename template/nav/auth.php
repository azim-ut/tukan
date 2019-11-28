<div id="fb-root"></div>

<div ng-controller="AuthBlockController" ng-cloak="" ng-init="check()" class="no-print">

    <div class="modal fade" tabindex="-1" role="dialog" id="AuthForm">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <div ng-if="tab == 'login'">
                        <form ng-submit="login(email, pwd, save)">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password" ng-model="pwd">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-success btn-block">Вход</button>
                            </div>

                            <div class="form-check">
                                <div class="left">
                                    <input class="form-check-input" type="checkbox" value="" id="saveMeCheck">
                                    <label class="form-check-label" for="saveMeCheck" style="margin-left: 20px;">
                                        Запомнить меня
                                    </label>
                                </div>
                                <div class="right" style="margin-left: 40px;">
                                    <a class="form-check-label" ng-click="setTab('forgot')">
                                        <label>Забыли пароль?</label>
                                    </a>
                                </div>
                            </div>
                            <hr/>
                            <div class="form-group">
                                <button ng-click="setTab('registration')"
                                        type="button"
                                        class="btn btn-success btn-block">Регистрация
                                </button>
                            </div>
                        </form>
                    </div>

                    <div ng-if="tab === 'forgot'">
                        <form ng-submit="resetPassword(email)">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-warning btn-block">Выслать новый пароль</button>
                            </div>
                        </form>
                        <hr/>
                        <div class="form-group">
                            <input ng-click="setTab('login')"
                                   type="button"
                                   value="Вход"
                                   class="btn btn-outline-success btn-block">
                        </div>
                    </div>
                    <div id="nasa_customer_login" class="nasa-relative" ng-if="tab == 'registration'">
                        <form ng-submit="register(name, email, pwd1, pwd2, terms)">

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon input-group-text">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Имя" ng-model="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Email" ng-model="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Пароль" ng-model="pwd1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Повторите пароль"
                                           ng-model="pwd2">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-warning btn-block">Зарегистрироваться</button>
                            </div>

                        </form>
                        <hr/>
                        <div class="form-group">
                            <input ng-click="setTab('login')"
                                   type="button"
                                   value="Вход"
                                   class="btn btn-outline-success btn-block">
                        </div>
                    </div>
                    <div class="text-center padding-bottom-20">
                        <span>или</span>
                        <br/>
                        <br/>
                    </div>
                    <div class="container">
                        <div class="row">
                            <button type="button" ng-click="loginFB()" class="btn btn-default btn-block btn-primary"><i
                                        class="icon-social-facebook"></i> Facebook вход
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



