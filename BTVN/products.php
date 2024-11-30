<?php
$products = [
    ['name' => 'Sản phẩm 1', 'price' => '1000'],
    ['name' => 'Sản phẩm 2', 'price' => '2000'],
    ['name' => 'Sản phẩm 3', 'price' => '3000'],
    ['name' => 'Sản phẩm 4', 'price' => '4000'],
    ['name' => 'Sản phẩm 5', 'price' => '5000'],
    ['name' => 'Sản phẩm 6', 'price' => '6000']
];

// Số sản phẩm trên mỗi trang
$items_per_page = 3;

// Lấy số trang hiện tại từ URL, mặc định là trang 1
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Tính tổng số trang
$total_items = count($products);
$total_pages = ceil($total_items / $items_per_page);

// Đảm bảo current_page nằm trong khoảng hợp lệ
$current_page = max(1, min($current_page, $total_pages));

// Tính vị trí bắt đầu lấy sản phẩm
$offset = ($current_page - 1) * $items_per_page;

// Lấy sản phẩm cho trang hiện tại
$current_products = array_slice($products, $offset, $items_per_page);
?>