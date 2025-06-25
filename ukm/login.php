<?php
session_start();
include 'config/db.php';

$pesan = "";

// Aktifkan error reporting untuk debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Gunakan hash yang sesuai dengan database Anda

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_login'] = $username;
        $_SESSION['admin_id'] = $admin['id']; // disimpan jika perlu

        // ✅ Catat log login
        $aktivitas = "Login berhasil";
        $log = $conn->prepare("INSERT INTO log_akses (admin_id, aktivitas, waktu) VALUES (?, ?, NOW())");
        $log->bind_param("is", $admin['id'], $aktivitas);
        $log->execute();

        header("Location: dashboard.php");
        exit;
    } else {
        $pesan = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Login Admin UKM</title>
  <style>
    body {
      background-color: #2f3f32;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 50px;
    }

    .box {
      background-color: #3e5341;
      padding: 30px;
      border-radius: 12px;
      display: inline-block;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      width: 300px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: none;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #2f3f32;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .error {
      color: #ff8888;
    }
  </style>
</head>
<body>

  <div class="box">
    <h2>Login Admin</h2>

    <?php if ($pesan != "") echo "<p class='error'>$pesan</p>"; ?>

    <form method="POST">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
  </div>

</body>
</html>
