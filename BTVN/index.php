<?php
session_start();
?>

<?php include 'header.php';?>
<?php include 'products.php';?>

<?php
// Initialize products array if not exists
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        ['id' => 1, 'name' => 'Sản phẩm 1', 'price' => '1000'],
        ['id' => 2, 'name' => 'Sản phẩm 2', 'price' => '2000'],
        ['id' => 3, 'name' => 'Sản phẩm 3', 'price' => '3000'],
        ['id' => 4, 'name' => 'Sản phẩm 4', 'price' => '4000'],
        ['id' => 5, 'name' => 'Sản phẩm 5', 'price' => '5000'],
        ['id' => 6, 'name' => 'Sản phẩm 6', 'price' => '6000']
    ];
}

// Pagination logic
$items_per_page = 3;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$total_items = count($_SESSION['products']);
$total_pages = ceil($total_items / $items_per_page);
$current_page = max(1, min($current_page, $total_pages));
$offset = ($current_page - 1) * $items_per_page;

// Get products for current page
$current_products = array_slice($_SESSION['products'], $offset, $items_per_page);

// Update index.php display section
?>
<main>
    <h1>Chào mừng đến với Trang Sản Phẩm của Chúng Tôi</h1>
    <h2>Danh Sách Sản Phẩm</h2>
    
    <div class="add-product">
        <a href="add_product.php" class="btn btn-success">Thêm Mới</a>
    </div>

    <div class="product-header">
        <span class="product-title">Sản phẩm</span>
        <span class="price-title">Giá thành</span>
        <span class="action-title">Sửa</span>
        <span class="action-title">Xóa</span>
    </div>

    <?php if (empty($_SESSION['products'])): ?>
        <p>Không có sản phẩm nào.</p>
    <?php else: ?>
        <ul class="product-list">
            <?php foreach ($current_products as $product): ?>
                <li class="product-item">
                    <span><?= htmlspecialchars($product['name']) ?></span>
                    <span class="price-tag"><?= number_format($product['price']) ?> VND</span>
                    <div class="actions">
                        <a href="edit_product.php?id=<?= $product['id'] ?>" 
                           class="action-icons edit" title="Sửa">✏️</a>
                        <a href="delete_product.php?id=<?= $product['id'] ?>" 
                           class="action-icons delete" title="Xóa">🗑️</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?page=1">Trang đầu</a>
                    <a href="?page=<?= $current_page - 1 ?>">←</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <?php if ($i == $current_page): ?>
                        <span class="current-page"><?= $i ?></span>
                    <?php else: ?>
                        <a href="?page=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?= $current_page + 1 ?>">→</a>
                    <a href="?page=<?= $total_pages ?>">Trang cuối</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>

