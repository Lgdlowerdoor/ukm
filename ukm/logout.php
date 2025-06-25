<?php
session_start();
include 'config/db.php';

if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $aktivitas = "Logout";
    $log = $conn->prepare("INSERT INTO log_akses (admin_id, aktivitas, waktu) VALUES (?, ?, NOW())");
    $log->bind_param("is", $admin_id, $aktivitas);
    $log->execute();
}

session_destroy();
header("Location: login.php");
exit;
?>
