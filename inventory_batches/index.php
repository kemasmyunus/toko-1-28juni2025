<?php
require '../db.php';
$stmt = $pdo->query("SELECT inventory_batches.*, products.nama_produk 
    FROM inventory_batches 
    JOIN products ON inventory_batches.product_id = products.id");
$batches = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Inventory Batches</h1>
<a href="create.php">+ Tambah Batch</a>
<table>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Quantity</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Tanggal Masuk</th>
        <th>Supplier</th>
        <th>ID Pembelian</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($batches as $b): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['nama_produk']) ?></td>
        <td><?= $b['quantity'] ?></td>
        <td><?= $b['harga_beli'] ?></td>
        <td><?= $b['harga_jual'] ?></td>
        <td><?= $b['tanggal_masuk'] ?></td>
        <td><?= htmlspecialchars($b['supplier']) ?></td>
        <td><?= htmlspecialchars($b['id_pembelian']) ?></td>
        <td>
            <a href="edit.php?id=<?= $b['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $b['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
