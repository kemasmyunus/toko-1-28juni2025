
<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>

<main class="content">
    <!-- ⬇ Tambahkan konten halaman utama di sini ⬇ -->
<?php
require '../db.php';
$stmt = $pdo->query("SELECT * FROM products");
$products = $stmt->fetchAll();
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Data Produk</h1>
<a href="create.php">+ Tambah Produk</a>
<table>
    <tr>
        <th>ID</th>
        <th>Item Code</th>
        <th>SKU</th>
        <th>Nama Produk</th>
        <th>Variant</th>
        <th>Brand</th>
        <th>Category</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['item_code']) ?></td>
        <td><?= htmlspecialchars($p['sku']) ?></td>
        <td><?= htmlspecialchars($p['nama_produk']) ?></td>
        <td><?= htmlspecialchars($p['variant']) ?></td>
        <td><?= htmlspecialchars($p['brand']) ?></td>
        <td><?= htmlspecialchars($p['category']) ?></td>
        <td>
            <a href="edit.php?id=<?= $p['id'] ?>">Edit</a>
            <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</main>

<?php include '../footer.php'; ?>
