<?php
require '../db.php';
$stmt = $pdo->query("SELECT * FROM customers");
$customers = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<h1>Data Customer</h1>
<a href="create.php">+ Tambah Customer</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($customers as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['nama']) ?></td>
        <td><?= htmlspecialchars($c['alamat']) ?></td>
        <td><?= htmlspecialchars($c['no_hp']) ?></td>
        <td>
            <a href="edit.php?id=<?= $c['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include '../includes/footer.php'; ?>
