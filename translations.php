<?php
header('Content-Type: application/json');

$translations = [
    'en' => [
        'men' => 'Men',
        'women' => 'Women',
        'children' => 'Children',
        'contacts' => 'Contacts',
        'shoes' => 'Shoes',
        'jeans' => 'Jeans',
        'shirts' => 'Shirts',
    ],
    'bg' => [
        'men' => 'Мъже',
        'women' => 'Жени',
        'children' => 'Деца',
        'contacts' => 'Контакти',
        'shoes' => 'Обувки',
        'jeans' => 'Дънки',
        'shirts' => 'Тениски',
    ],
];

$lang = $_GET['lang'] ?? 'bg';
echo json_encode($translations[$lang] ?? $translations['bg']);
