<? include_once __DIR__ . "/../nav/start.php" ?>

    <div id="content" class="HeadContentPage" ng-init="contents = []">
        <div class="row">
            <div>
                <h1>Правила</h1>
                <div class="ContentsList">
                    <ul style="list-style: none;">
                        <a href="{{row.href}}" ng-repeat="row in contents">
                            <li style="text-decoration: underline;">{{row.ttl}}</li>
                        </a>
                    </ul>
                </div>

                <a id="order">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'Заказ товара', href:'#order'})">Заказ товара <a href="#!#top"
                                                                                                 style="color: #ccc;">[вверх]</a>
                </h2>
                <p>
                    Выберите подходящие Вам изделия и добавьте их в корзину покупок. В корзине покупок Вы можете
                    редактировать список выбраных товаров.
                </p>
                <p>
                    Выберите наиболее подходящий Вам способ оплаты, заполните при необходимости поля с личными данными и
                    нажмите на кнопку «оформить заказ».
                </p>
                <p>
                    После заполнения на странице оформления заказа необходимых полей нажмите кнопку «Купить». После
                    оплаты счета покупка считается совершенной.
                </p>

                <a id="delivery">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'Доставка', href:'#delivery'})">Доставка <a href="#!#top"
                                                                                            style="color: #ccc;">[вверх]</a>
                </h2>
                <p>
                    Во время оформления заказа требуется указать точный адрес доставки. В случае вопросов по адресу
                    доставки - наш специалист свяжется с вами
                </p>
                <p>
                    Отправка товара осуществляется не позднее трёх дней после получения оплаты за покупку.
                </p>

                <a id="pay">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'Оплата', href:'#pay'})">Оплата <a href="#!#top" style="color: #ccc;">[вверх]</a>
                </h2>
                <p>
                    Покупку можно оплатить банковским переводом или кредитной картой.
                </p>
                <p>
                    При оплате банковским переводом - укажите номер сделки в ссылке на перевод.
                </p>
                <p>
                    Оплата наличными доступна при доставке курьером в Таллине. Чек оплаты будет выдан после оплаты
                    товара.
                </p>

                <a id="moneyback">&nbsp;</a>
                <br/>
                <br/>
                <br/>
                <h2 ng-init="contents.push({ttl:'Гарантия возврата денег', href:'#moneyback'})">Гарантия возврата денег
                    <a href="#!#top" style="color: #ccc;">[вверх]</a></h2>
                <p>
                    Товар, который вам не подошел, можно вернуть в течение 14 дней в оригинальной
                    упаковке.
                </p>
                <p>
                    Транспортные расходы, связанные с возвратом товара, покрывает потребитель.
                </p>
                <p>
                    Покупатели не могут видеть товары в интернет-магазине, поэтому законы, защищающие интересы
                    потребителей в сфере электронной коммерции, предоставляют одно из важнейших средств защиты прав
                    потребителей - право отказаться от договора о дистанционной продаже.
                </p>
                <p>
                    Продавец должен быть уведомлен об отзыве в письменном виде. Для этого - в течении четырнадцать
                    рабочих дней в списке Заказов требуется нажать "Открыть спор" напротив оспариваемого
                    заказа. В открывшейся форме требуется изложить суть претензий.
                </p>
                <p>
                    Если на нашем складе есть товары, которые мы не можем предоставить нашим клиентам, мы всегда
                    свяжемся с ними и предложим вам обмен или возврат. Возврат занимает до 7 рабочих дней.
                </p>
            </div>
        </div>
    </div>
<? include_once __DIR__ . "/../nav/footer.php" ?>