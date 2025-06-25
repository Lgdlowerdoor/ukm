<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Sistem Pendaftaran UKM' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background-color: #2f3f32;
      color: white;
      font-family: Arial, sans-serif;
      text-align: center;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #3e5341;
      padding: 20px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.3);
    }

    header h1 {
      margin: 0;
      font-size: 26px;
    }

    main.container {
      padding: 30px 20px;
      max-width: 1100px;
      margin: 0 auto;
      text-align: left;
    }

    a {
      color: #add8e6;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    nav {
      text-align: right;
      margin-top: 10px;
    }

    .nav-link {
      margin-left: 20px;
      color: #add8e6;
    }
  </style>
</head>
<body>

<header>
  <h1>Sistem Pendaftaran UKM</h1>

  <?php if (isset($_SESSION['admin_login'])): ?>
    <nav>
      <span>Login sebagai <strong><?= $_SESSION['admin_login'] ?></strong></span>
      <a class="nav-link" href="dashboard.php">Dashboard</a>
      <a class="nav-link" href="admin_panel.php">Data Pendaftar</a>
      <a class="nav-link" href="logout.php">Logout</a>
    </nav>
  <?php endif; ?>
</header>

<main class="container">
