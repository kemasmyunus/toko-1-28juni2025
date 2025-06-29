<?php
require '../db.php';
$stmt = $pdo->query("SELECT * FROM warehouses");
$warehouses = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<h1>Data Gudang</h1>
<a href="create.php">+ Tambah Gudang</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Gudang</th>
        <th>Alamat</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($warehouses as $w): ?>
    <tr>
        <td><?= $w['id'] ?></td>
        <td><?= htmlspecialchars($w['nama']) ?></td>
        <td><?= htmlspecialchars($w['alamat']) ?></td>
        <td>
            <a href="edit.php?id=<?= $w['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $w['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>