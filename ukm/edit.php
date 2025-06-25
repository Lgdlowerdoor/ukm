<?php
$title = "Edit Data Pendaftar";
include 'config/db.php';
include 'templates/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM pendaftar WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
} else {
    die("<div class='box'><h3 style='color:red;'>ID tidak ditemukan.</h3></div>");
}
?>

<div class="box">
  <h2>Edit Data Pendaftar</h2>

  <form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?= $data['id'] ?>">

    <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required placeholder="Nama"><br>
    <input type="text" name="npm" value="<?= htmlspecialchars($data['npm']) ?>" required placeholder="NPM"><br>
    <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required placeholder="Email"><br>

    <label>Pilih maksimal 2 UKM:</label><br>

    <?php
    $daftar_ukm = ['UKM Seni', 'UKM Olahraga', 'UKM Pecinta Alam', 'UKM Pramuka', 'UKM Robotika'];
    $ukm_terpilih = [$data['ukm1'], $data['ukm2']];
    foreach ($daftar_ukm as $ukm) {
        $checked = in_array($ukm, $ukm_terpilih) ? 'checked' : '';
        echo "<input type='checkbox' name='ukm[]' value='$ukm' $checked> $ukm<br>";
    }
    ?>

    <input type="submit" value="Update">
  </form>
</div>

<script>
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  checkboxes.forEach(cb => cb.addEventListener('change', () => {
    const checkedCount = [...checkboxes].filter(c => c.checked).length;
    if (checkedCount > 2) {
      alert("Maksimal hanya 2 UKM.");
      cb.checked = false;
    }
  }));
</script>

<?php include 'templates/footer.php'; ?>
