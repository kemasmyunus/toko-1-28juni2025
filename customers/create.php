<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?><?php
require '../db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO customers (nama, alamat, no_hp) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['no_hp']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Customer</h1>
<form method="post">
    <label>Nama</label>
    <input type="text" name="nama" required>
    <label>Alamat</label>
    <input type="text" name="alamat" required>
    <label>No HP</label>
    <input type="text" name="no_hp" required>
    <input type="submit" value="Simpan">
</form>
<?php include '../includes/footer.php'; ?>