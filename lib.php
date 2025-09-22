<?php

function switch_product(string $product_name): array {
    $product = [
        "name" => $product_name,
        "price" => 0
    ];
     
    switch ($product_name) {
        case 'Ручка':
            $product['price'] = 10;
            break;
    
        case 'Книга':
            $product['price'] = 100;
            break;
       
        case 'Сувенир':
            $product['price'] = 1000;
            break;

        case 'Компьютер':
            $product['price'] = 10000;
            break;

        default:
            $product['price'] = 0;
            break;
    }

    return $product;
}

function create_if_file_exists(string $file): void {
    if(!file_exists($file)) {
        file_put_contents('data.txt', '');
    }
}

function discount_pen_and_book(int $count): float {
    if($count < 5) {
        return 0.05;
    } else if ($count < 10) {
        return 0.1;
    }
    
    return 0.2;
}

function discount_suvenir_and_pc(int $count): float {
    if($count > 10 && $count < 20) {
        return 0.1;
    } else if ($count > 20 && $count < 30) {
        return 0.2;
    }
    
    return 0.4;
}

function discount_product(string $product_name, int $count): float {
    $discount = 0.0;

    switch ($product_name) {
        case 'Ручка':
            $discount = discount_pen_and_book($count);
            break;
        
        case 'Книга':
            $discount = discount_pen_and_book($count);
            break;

        case 'Сувенир':
            $discount = discount_suvenir_and_pc($count);
            break;

        case 'Компьютер':
            $discount = discount_suvenir_and_pc($count);
            break;

        default:
            # code...
            break;
    }

    return $discount;
}

function write_data_file(string $file_name, array $data): void {
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

    $file = fopen($file_name, 'a');
    fwrite($file, $format_string);
    fclose($file);
}