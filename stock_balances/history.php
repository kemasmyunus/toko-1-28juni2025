<?php
require '../db.php';
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT stock_history.*, products.nama_produk, warehouses.nama AS nama_gudang 
    FROM stock_history 
    JOIN products ON stock_history.product_id = products.id 
    JOIN warehouses ON stock_history.warehouse_id = warehouses.id 
    WHERE stock_id = ? 
    ORDER BY updated_at DESC");
$stmt->execute([$id]);
$logs = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Riwayat Perubahan Stock</h1>
<a href="index.php">← Kembali</a>
<table>
    <tr>
        <th>Tanggal</th>
        <th>Produk</th>
        <th>Gudang</th>
        <th>Quantity Lama</th>
        <th>Quantity Baru</th>
        <th>Diupdate Oleh</th>
    </tr>
    <?php foreach ($logs as $log): ?>
    <tr>
        <td><?= $log['updated_at'] ?></td>
        <td><?= htmlspecialchars($log['nama_produk']) ?></td>
        <td><?= htmlspecialchars($log['nama_gudang']) ?></td>
        <td><?= $log['old_quantity'] ?></td>
        <td><?= $log['new_quantity'] ?></td>
        <td><?= htmlspecialchars($log['updated_by']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
