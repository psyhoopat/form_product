<?php 


?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="static/styles/style.css">
</head>
<body>
    <div class="wrapper">
        <h1>Каталог товаров</h1>
        <div class="showncase">
            <div class="card">
                <img src="static/img/ruchka.gif" alt="pen">
                <p>Ручка <br/> 10 руб.</p>
            </div>
            <div class="card">
                <img src="static/img/kniga.gif" alt="book">
                <p>Книга <br/> 100 руб.</p>
            </div>
            <div class="card">
                <img src="static/img/suvenir.jpg" alt="suvenir">
                <p>Сувенир <br/> 1000 руб.</p>
            </div>
            <div class="card">
                <img src="static/img/komp.jpg" alt="pc">
                <p>Компьютер <br/> 10000 руб.</p>
            </div>
        </div>

        <h1>Заказ</h1>
        <form class="order" action="/form_product/success.php" method="POST">
            <div>
                <label for="product">Вид товара</label>
                <select name="product" id="product">
                    <option value="">--Выберите товар--</option>
                    <option value="Ручка">Ручка</option>
                    <option value="Книга">Книга</option>
                    <option value="Сувенир">Сувенир</option>
                    <option value="Компьютер">Компьютер</option>
                </select>
            </div>

            <div>
                <label for="count">Количество</label>
                <input 
                    type="number" 
                    step="1" 
                    min="1" 
                    max="100" 
                    value="1" 
                    id="count" 
                    name="count"
                />
            </div>

            <fieldset>
                <legend>Форма оплаты</legend>

                <div>
                    <input type="radio" id="bank" name="pay" value="Банковская крата" checked />
                    <label for="bank">Банковская карта</label>
                </div>

                <div>
                    <input type="radio" id="mail" name="pay" value="Почтовая карта" />
                    <label for="mail">Почтовая карта</label>
                </div>

                <div>
                    <input type="radio" id="web" name="pay" value="Web-money" />
                    <label for="web">Web-money</label>
                </div>
            </fieldset>

            <div>
                <label for="user">Фамилия Имя Отчество</label>
                <input name="user" type="text" placeholder="Иванов Иван Иванович">
            </div>

            <div>
                <label for="address">Адрес доставки</label>
                <textarea  name="address" id="address"></textarea>
            </div>

            <div class="row-buttons">
                <button type="submit">Отправить заказ</button>
                <button type="reset">Очистить заказ</button>
            </div>
        </form>
    </div>
</body>
</html>