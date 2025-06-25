<?php
$title = "Panel Admin - Data Pendaftar";
include 'config/auth.php';
include 'config/db.php';
include 'templates/header.php';

$keyword = $_GET['search'] ?? "";

$sql = "SELECT * FROM pendaftar WHERE 
        nama LIKE ? OR 
        npm LIKE ? OR 
        ukm1 LIKE ? OR 
        ukm2 LIKE ?
        ORDER BY waktu_daftar DESC";

$stmt = $conn->prepare($sql);
$searchTerm = "%$keyword%";
$stmt->bind_param("ssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
?>

<style>
  .actions {
    margin-top: 15px;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
  }

  form.search-form {
    margin-bottom: 15px;
    display: flex;
    justify-content: center;
    gap: 10px;
    flex-wrap: wrap;
  }

  input[type="text"] {
    padding: 8px;
    width: 250px;
    border-radius: 6px;
    border: none;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    color: black;
    margin-top: 20px;
  }

  th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: center;
  }

  th {
    background-color: #445f4c;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tr:hover {
    background-color: #e8e8e8;
  }

  a {
    color: #1177cc;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }

  .btn {
    background-color: #2f3f32;
    color: white;
    padding: 8px 15px;
    text-decoration: none;
    border-radius: 6px;
    display: inline-block;
  }

  .btn:hover {
    background-color: #4d6a56;
  }
</style>

<div class="box">
  <h2>Data Pendaftar UKM</h2>

  <form method="GET" class="search-form">
    <input type="text" name="search" placeholder="Cari Nama / NPM / UKM..." value="<?= htmlspecialchars($keyword) ?>">
    <input type="submit" class="btn" value="Cari">
    <a href="admin_panel.php" class="btn">Reset</a>
  </form>

  <div class="actions">
    <a href="export_pdf.php" class="btn">Export PDF</a>
    <a href="export_excel.php" class="btn">Export Excel</a>
    <a href="dashboard.php" class="btn">Dashboard</a>
    <a href="logout.php" class="btn">Logout</a>
  </div>

  <table>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NPM</th>
      <th>Email</th>
      <th>UKM 1</th>
      <th>UKM 2</th>
      <th>Waktu Daftar</th>
      <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['nama']}</td>
                <td>{$row['npm']}</td>
                <td>{$row['email']}</td>
                <td>{$row['ukm1']}</td>
                <td>{$row['ukm2']}</td>
                <td>{$row['waktu_daftar']}</td>
                <td>
                  <a href='edit.php?id={$row['id']}'>Edit</a> | 
                  <a href='delete.php?id={$row['id']}' onclick=\"return confirm('Yakin ingin menghapus?');\">Hapus</a>
                </td>
              </tr>";
        $no++;
    }

    if ($result->num_rows == 0) {
        echo "<tr><td colspan='8'>Tidak ada data ditemukan.</td></tr>";
    }
    ?>
  </table>
</div>

<?php include 'templates/footer.php'; ?>
