<?php include '../includes/header.php'; ?>
<?php include '../includes/sidebar.php'; ?><?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM customers WHERE id = ?");
$stmt->execute([$id]);
$c = $stmt->fetch();

if (!$c) {
    die("Customer tidak ditemukan");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("UPDATE customers SET nama=?, alamat=?, no_hp=? WHERE id=?");
    $stmt->execute([
        $_POST['nama'],
        $_POST['alamat'],
        $_POST['no_hp'],
        $id
    ]);
    header("Location: index.php");
}
?>
<link rel="stylesheet" href="../css/style.css">
<h1>Edit Customer</h1>
<form method="post">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($c['nama']) ?>" required>
    <label>Alamat</label>
    <input type="text" name="alamat" value="<?= htmlspecialchars($c['alamat']) ?>" required>
    <label>No HP</label>
    <input type="text" name="no_hp" value="<?= htmlspecialchars($c['no_hp']) ?>" required>
    <input type="submit" value="Update">
</form>
<?php include '../includes/footer.php'; ?>