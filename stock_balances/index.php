<?php
require '../db.php';
$stmt = $pdo->query("SELECT stock_balances.*, products.nama_produk, warehouses.nama AS nama_gudang 
    FROM stock_balances 
    JOIN products ON stock_balances.product_id = products.id 
    JOIN warehouses ON stock_balances.warehouse_id = warehouses.id");
$stocks = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Stock Balances</h1>
<a href="create.php">+ Tambah Stock</a>
<table>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Gudang</th>
        <th>Quantity</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($stocks as $s): ?>
    <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['nama_produk']) ?></td>
        <td><?= htmlspecialchars($s['nama_gudang']) ?></td>
        <td><?= $s['quantity'] ?></td>
        <td>
            <a href="edit.php?id=<?= $s['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
