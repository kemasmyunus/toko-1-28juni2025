<?php
require '../db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO products (item_code, sku, nama_produk, variant, brand, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['item_code'],
        $_POST['sku'],
        $_POST['nama_produk'],
        $_POST['variant'],
        $_POST['brand'],
        $_POST['category']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Produk</h1>
<form method="post">
    <label>Item Code</label>
    <input type="text" name="item_code" required>
    <label>SKU</label>
    <input type="text" name="sku" required>
    <label>Nama Produk</label>
    <input type="text" name="nama_produk" required>
    <label>Variant</label>
    <input type="text" name="variant">
    <label>Brand</label>
    <input type="text" name="brand">
    <label>Category</label>
    <input type="text" name="category">
    <input type="submit" value="Simpan">
</form>
