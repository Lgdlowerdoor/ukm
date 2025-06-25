<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Pendaftar UKM</title>
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
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      display: inline-block;
      width: 90%;
      max-width: 1000px;
    }

    table {
      margin: 20px auto;
      background-color: #ffffff;
      color: #000;
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
    }

    th {
      background-color: #3e5341;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #e2e2e2;
    }

    a {
      color: #0e7cc0;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    .btn-kembali {
      margin-top: 20px;
      display: inline-block;
      padding: 10px 20px;
      background-color: #3e5341;
      color: white;
      border-radius: 8px;
      text-decoration: none;
    }

    .btn-kembali:hover {
      background-color: #566b59;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Daftar Pendaftar UKM</h2>

    <?php
    include 'config/db.php';
    $result = $conn->query("SELECT * FROM pendaftar ORDER BY waktu_daftar DESC");

    if ($result->num_rows > 0) {
      echo "<table>
              <tr>
                <th>Nama</th>
                <th>NPM</th>
                <th>Email</th>
                <th>UKM 1</th>
                <th>UKM 2</th>
                <th>Aksi</th>
              </tr>";

      while ($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>" . htmlspecialchars($row['nama']) . "</td>
                  <td>{$row['npm']}</td>
                  <td>{$row['email']}</td>
                  <td>{$row['ukm1']}</td>
                  <td>{$row['ukm2']}</td>
                  <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> | 
                    <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                  </td>
                </tr>";
      }

      echo "</table>";
    } else {
      echo "<p style='color: #ccc;'>Belum ada data pendaftar.</p>";
    }
    ?>

    <a class="btn-kembali" href="index.php">+ Tambah Pendaftaran Baru</a>
  </div>
</body>
</html>
