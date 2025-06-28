<?php
require '../db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO warehouses (nama, alamat) VALUES (?, ?)");
    $stmt->execute([
        $_POST['nama'],
        $_POST['alamat']
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Tambah Gudang</h1>
<form method="post">
    <label>Nama Gudang</label>
    <input type="text" name="nama" required>
    <label>Alamat</label>
    <input type="text" name="alamat" required>
    <input type="submit" value="Simpan">
</form>
