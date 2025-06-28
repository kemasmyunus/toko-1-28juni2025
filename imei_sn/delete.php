<?php
require '../db.php';
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM imei_sn WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
