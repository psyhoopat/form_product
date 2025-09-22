<?php

const DEBUG = true;

if(empty($_POST)) {
    header('Location: /form_product');
}

date_default_timezone_set('Europe/Moscow');

// подключить функции
require_once 'lib.php';

// получить данные с формы
$data = [
    "product" => $_POST['product'],
    "count" => $_POST['count'],
    "pay" => $_POST['pay'],
    "user" => $_POST['user'],
    "address" =>  $_POST['address']
];

// цена товара
$data['price'] = get_price_product($data['product']);

// общая цена = товар * количество
$data['total_price'] = $data['price'] * $data['count'];
// получить скидку в процентах и умножить на 100
$data['discount_product'] = discount_product($data['product'], $data['count']) * 100;
// скидка в рублях (общая цена * скидка в процентах)/100
$data['discount_price'] = ($data['total_price'] * $data['discount_product'])/100;
// Налог (общая цена * налог)/100
$data['tax_sell'] = ($data['total_price'] * 18)/100;

// Общая стоимость включая скидки, доставки и налога 500 + (общая цена - скидка в рублях) + налог
$data['total'] = 500 + ($data['total_price'] - $data['discount_price']) + $data['tax_sell'];

// создать файл data.txt
$file_name = 'data.txt';
create_if_file_exists($file_name);

// записать формат данных
$format_string = "
    Заказчик: ".$data['user']."
    Способ оплаты: ".$data['pay']."
    Товар: ".$data['name']."
    Цена за одну штуку: ".$data['price']." руб.
    Количество: ".$data['count']." шт.
    Итоговая цена: ".$data['total_price']." руб.
    Скидка: ".$data['discount']."%
    Адрес: ".$data['address']."
    Стоимость заказа с учетом скидки, доставки и налога с продаж: ".$data['total']." руб.\n
\n";

// записать в файл data.txt
write_data_file(
    $file_name,
    $format_string
);

// очистить данные POST
unset($_POST['product'], $_POST['count'], $_POST['pay'], $_POST['user'], $_POST['address']);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ</title>
    <link rel="stylesheet" href="static/styles/success.css">
</head>
<body>
    <h1 class="red">Результаты заказа</h1>
    <h3 class="red">Заказ обработан в <?= date("H:i, jS F") ?></h3>

    <div>
        <h3>Список вашего заказ:</h3>

        <p>Товар - <?= $data['product'] ?></p>
        <p>Стоимость 1 шт. - <?= $data['price'] ?></p>
        <p>Количество заказанных товаров - <?= $data['count'] ?> шт.</p>

        <p>Общая стоимость заказа - <?= $data['total_price'] ?> руб.</p>

        <p>Стоимость доставки - 500 руб.</p>

        <p>Налог с продаж - 18%</p>
        <p>Ваша скидка - <?= $data['discount_product '] ?>% (<?= $data['discount_price'] ?> руб.)</p>
        <p>Стоимость заказа с учетом скидки, доставки и налога с продаж - <?= $data['total'] ?> руб.</p>
        <p>Адрес доставки - <?= $data['address'] ?></p>

    </div>
    
    <a href="/form_product">Вернутся назад</a>

    <?php if(DEBUG): ?>
        <pre><?php print_r($data) ?></pre>
    <?php endif; ?>
</body>
</html>