<?php 

date_default_timezone_set('Europe/Moscow');

require_once 'lib.php';

$data = [
    "product" => $_POST['product'],
    "count" => $_POST['count'],
    "pay" => $_POST['pay'],
    "user" => $_POST['user'],
    "address" =>  $_POST['address']
];

$product = switch_product($data['product']);

$total_price = $product['price'] * $data['count'];
$discount_product = discount_product($product['name'], $data['count']) * 100;
$discount_price = ($total_price * $discount_product)/100;
$tax_sell = ($total_price * 18)/100;

$total = 500 + ($total_price - $discount_price) + $tax_sell;

$data_write = [
    "user" => $data['user'],
    "pay" => $data['pay'],
    "name" => $product['name'],
    "price" => $product['price'],
    "count" => $data['count'],
    "total_price" => $total_price,
    "discount" => $discount_price,
    "total" => $total,
    "address" => $data['address']
];

$file_name = 'data.txt';
create_if_file_exists($file_name);

write_data_file(
    $file_name, 
    $data_write
);

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
    <h3 class="red">Заказ обработан в <?php echo date("H:i, jS F"); ?></h3>

    <div>
        <h3>Список вашего заказ:</h3>

        <p>Товар - <?= $product['name']; ?></p>
        <p>Стоимость 1 шт. - <?= $product['price'] ?></p>
        <p>Количество заказанных товаров - <?= $data['count']; ?> шт.</p>

        <p>Общая стоимость заказа - <?= $total_price ?> руб.</p>

        <p>Стоимость доставки - 500 руб.</p>

        <p>Налог с продаж - 18%</p>
        <p>Ваша скидка - <?= $discount_product ?>% (<?= $discount_price ?> руб.)</p>
        <p>Стоимость заказа с учетом скидки, доставки и налога с продаж - <?= $total ?> руб.</p>
        <p>Адрес доставки - <?= $data['address']; ?></p>

    </div>
    
    <a href="/form_product">Вернутся назад</a>
</body>
</html>