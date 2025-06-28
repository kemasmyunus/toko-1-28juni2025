<?php
require '../db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    die("Produk tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE products SET item_code=?, sku=?, nama_produk=?, variant=?, brand=?, category=? WHERE id=?");
    $stmt->execute([
        $_POST['item_code'],
        $_POST['sku'],
        $_POST['nama_produk'],
        $_POST['variant'],
        $_POST['brand'],
        $_POST['category'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Produk</h1>
<form method="post">
    <label>Item Code</label>
    <input type="text" name="item_code" value="<?= htmlspecialchars($product['item_code']) ?>" required>
    <label>SKU</label>
    <input type="text" name="sku" value="<?= htmlspecialchars($product['sku']) ?>" required>
    <label>Nama Produk</label>
    <input type="text" name="nama_produk" value="<?= htmlspecialchars($product['nama_produk']) ?>" required>
    <label>Variant</label>
    <input type="text" name="variant" value="<?= htmlspecialchars($product['variant']) ?>">
    <label>Brand</label>
    <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>">
    <label>Category</label>
    <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>">
    <input type="submit" value="Update">
</form>
