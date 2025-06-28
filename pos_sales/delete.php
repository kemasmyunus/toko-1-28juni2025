<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM pos_sales WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
