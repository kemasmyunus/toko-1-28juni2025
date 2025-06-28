<?php
require '../db.php';
$sale_id = $_GET['sale_id'] ?? null;
if (!$sale_id) {
    die("Sale ID tidak ada.");
}

$products = $pdo->query("SELECT * FROM products")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO pos_sale_details 
        (pos_sale_id, product_id, quantity, harga_jual, potongan1, potongan2, potongan3, total_setelah_potongan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $sale_id,
        $_POST['product_id'],
        $_POST['quantity'],
        $_POST['harga_jual'],
        $_POST['potongan1'],
        $_POST['potongan2'],
        $_POST['potongan3'],
        $_POST['total_setelah_potongan']
    ]);
    header("Location: index.php?sale_id=$sale_id");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Item untuk Transaksi #<?= $sale_id ?></h1>
<form method="post">
    <label>Produk</label>
    <select name="product_id" required>
        <?php foreach ($products as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama_produk']) ?></option>
        <?php endforeach; ?>
    </select>
    <label>Quantity</label>
    <input type="number" name="quantity" required>
    <label>Harga Jual</label>
    <input type="number" name="harga_jual" step="0.01" required>
    <label>Potongan 1</label>
    <input type="number" name="potongan1" step="0.01" value="0">
    <label>Potongan 2</label>
    <input type="number" name="potongan2" step="0.01" value="0">
    <label>Potongan 3</label>
    <input type="number" name="potongan3" step="0.01" value="0">
    <label>Total Setelah Potongan</label>
    <input type="number" name="total_setelah_potongan" step="0.01" required>
    <input type="submit" value="Simpan">
</form>
