<?php
require '../db.php';
$stmt = $pdo->query("SELECT stock_opname.*, products.nama_produk, warehouses.nama AS nama_gudang 
    FROM stock_opname 
    JOIN products ON stock_opname.product_id = products.id 
    JOIN warehouses ON stock_opname.warehouse_id = warehouses.id");
$data = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Stock Opname</h1>
<a href="create.php">+ Buat Stock Opname</a>
<table>
    <tr>
        <th>ID</th>
        <th>Produk</th>
        <th>Gudang</th>
        <th>Qty Sistem</th>
        <th>Qty Fisik</th>
        <th>Selisih</th>
        <th>Tanggal</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($data as $d): ?>
    <tr>
        <td><?= $d['id'] ?></td>
        <td><?= htmlspecialchars($d['nama_produk']) ?></td>
        <td><?= htmlspecialchars($d['nama_gudang']) ?></td>
        <td><?= $d['quantity_sistem'] ?></td>
        <td><?= $d['quantity_fisik'] ?></td>
        <td><?= $d['selisih'] ?></td>
        <td><?= $d['tanggal'] ?></td>
        <td><?= htmlspecialchars($d['keterangan']) ?></td>
        <td>
            <a href="delete.php?id=<?= $d['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
