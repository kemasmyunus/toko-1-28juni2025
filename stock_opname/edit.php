<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM warehouses WHERE id = ?");
$stmt->execute([$id]);
$w = $stmt->fetch();

if (!$w) {
    die("Gudang tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE warehouses SET nama=?, alamat=? WHERE id=?");
    $stmt->execute([
        $_POST['nama'],
        $_POST['alamat'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Gudang</h1>
<form method="post">
    <label>Nama Gudang</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($w['nama']) ?>" required>
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($w['alamat']) ?>" required>
    <input type="submit" value="Update">
</form>
