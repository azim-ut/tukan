<? use core\exception\BadResultException;
use core\exception\NoUserException;
use core\manager\UserManager;
use core\utils\StringUtils;

try{
    $user = UserManager::current();
    if(!$user){
        throw new NoUserException();
    }
}catch(NoUserException | BadResultException $e){
    header("Location: /");
    exit();
}
include_once __DIR__ . "/../nav/start.php";

?>
    <div ng-controller="AuthBlockController" ng-cloak class="HeadContentPage">
        <div class="container">
            <div class="row">
                <div class="col-sm-1">
                    &nbsp;
                </div>

                <div class="col-sm-3 margin-bottom-15">
                    <div class="list-group">
                        <a href="/cart" class="list-group-item">Корзина</a>
                        <a href="/orders" class="list-group-item">Мои заказы</a>
                        <a href="/addresses" class="list-group-item">Адреса доставки</a>
                    </div>
                    <div class="list-group">
                        <a href="/logout" class="list-group-item">Выйти</a>
                    </div>
                </div>


                <div class="col-sm-7 padding-left-15" style="padding: 20px;">
                    <?
                    if(!StringUtils::isEmpty($user->name())){
                        ?>Привет, <?=$user->name()?>!<?
                    }else{
                        echo "Приветствуем!";
                    }
                    ?>

                    <div class="row grid2 margin-top-15">
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">0</div>
                            Все заказы
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">0</div>
                            Ожидается платеж
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">0</div>
                            Ожидается отправка
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">0</div>
                            Заказ отправлен
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">0</div>
                            Ожидается отзыв
                        </div>
                        <div class="block text-center col-6 col-sm-2">
                            <div class="cnt">0</div>
                            Открытые спорты
                        </div>
                    </div>

                </div>

                <div class="col-sm-1">
                </div>
            </div>
        </div>
    </div>


<? include_once __DIR__ . "/../nav/footer.php" ?>