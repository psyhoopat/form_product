<?php

/**
 * @param string $product_name имя товара
 * @return int цена
 * @description По названию товара вернет цену
 */
function get_price_product(string $product_name): int {
    switch ($product_name) {
        case 'Ручка':
            $price = 10;
            break;
    
        case 'Книга':
            $price = 100;
            break;
       
        case 'Сувенир':
            $price = 1000;
            break;

        case 'Компьютер':
            $price= 10000;
            break;

        default:
            $price = 0;
            break;
    }

    return $price;
}

/**
 * @param string $file имя файла
 * @return void
 * @description Функция проверяет есть ли файл, при отсутствии файл будет создан
 */
function create_if_file_exists(string $file): void {
    if(!file_exists($file)) {
        file_put_contents('data.txt', '');
    }
}

/**
 * @param int $count количество
 * @return float
 * @description Функция возвращает скидку товара для ручки и книжки
 */
function discount_pen_and_book(int $count): float {
    if($count < 5) {
        return 0.05;
    } else if ($count < 10) {
        return 0.1;
    }

    return 0.2;
}

/**
 * @param int $count количество
 * @return float
 * @description Функция возвращает скидку товара для сувенира и компьютера
 */
function discount_souvenir_and_pc(int $count): float {
    if($count > 10 && $count < 20) {
        return 0.1;
    } else if ($count > 20 && $count < 30) {
        return 0.2;
    }
    
    return 0.4;
}

/**
 * @param string $product_name имя товара
 * @param int $count количество товара
 * @return float
 * @description Функция возвращает скидку для сувенира и компьютера
 */
function discount_product(string $product_name, int $count): float {
    switch ($product_name) {
        case 'Книга':
        case 'Ручка':
            $discount = discount_pen_and_book($count);
            break;

        case 'Компьютер':
        case 'Сувенир':
            $discount = discount_souvenir_and_pc($count);
            break;

        default:
            $discount = 0;
            break;
    }

    return $discount;
}

/**
 * @param string $file_name имя файла
 * @param string $data загрузить данные
 * @return void
 * @description Процедура записывает заказы в файл
 */
function write_data_file(string $file_name, string $data): void {
    $file = fopen($file_name, 'a');
    fwrite($file, $data);
    fclose($file);
}