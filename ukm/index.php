<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Pendaftaran UKM</title>
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
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      display: inline-block;
      text-align: left;
      max-width: 400px;
      width: 100%;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 6px;
      border: none;
    }

    input[type="checkbox"] {
      margin-right: 8px;
    }

    input[type="submit"] {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #2f3f32;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #445f4c;
    }

    label {
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="box">
    <h2>Pendaftaran UKM Universitas Lampung</h2>
    <form method="POST" action="proces_register.php">
      <label for="nama">Nama:</label><br>
      <input type="text" name="nama" id="nama" required placeholder="Nama Lengkap"><br>

      <label for="npm">NPM:</label><br>
      <input type="text" name="npm" id="npm" required placeholder="Nomor Pokok Mahasiswa"><br>

      <label for="email">Email:</label><br>
      <input type="email" name="email" id="email" required placeholder="Alamat Email Aktif"><br>

      <label>Pilih maksimal 2 UKM:</label><br>
      <input type="checkbox" name="ukm[]" value="UKM Seni"> UKM Seni<br>
      <input type="checkbox" name="ukm[]" value="UKM Olahraga"> UKM Olahraga<br>
      <input type="checkbox" name="ukm[]" value="UKM Pecinta Alam"> UKM Pecinta Alam<br>
      <input type="checkbox" name="ukm[]" value="UKM Pramuka"> UKM Pramuka<br>
      <input type="checkbox" name="ukm[]" value="UKM Robotika"> UKM Robotika<br>

      <input type="submit" name="submit" value="Daftar">
    </form>
  </div>

  <script>
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(cb => cb.addEventListener('change', () => {
      const checkedCount = [...checkboxes].filter(c => c.checked).length;
      if (checkedCount > 2) {
        alert("Hanya boleh memilih maksimal 2 UKM.");
        cb.checked = false;
      }
    }));
  </script>

</body>
</html>
