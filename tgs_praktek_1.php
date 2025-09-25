<html>
<head>
    <title>Input Data Siswa</title>
</head>
<body>
    <?php
    // Kalau belum ada jumlah siswa & data siswa
    if (!isset($_POST['jumlah']) && !isset($_POST['nama'])) {
    ?>
        <!-- Form pertama: nanya jumlah siswa -->
        <form method="post">
            <label>Masukkan jumlah siswa: </label>
            <input type="number" name="jumlah" min="1" required>
            <input type="submit" value="Submit">
        </form>
    <?php
    } 
    // Kalau sudah input jumlah siswa, tampilkan form input data siswa
    elseif (isset($_POST['jumlah']) && !isset($_POST['nama'])) {
        $jumlah = $_POST['jumlah'];
        ?>
        <form method="post">
            <input type="hidden" name="jumlah" value="<?php echo $jumlah; ?>">
            <?php
            for ($i = 1; $i <= $jumlah; $i++) {
                echo "<h3>Data Siswa ke-$i</h3>";
                echo "NISN: <input type='text' name='nisn[]' required><br>";
                echo "Nama Siswa: <input type='text' name='nama[]' required><br>";
                echo "Jurusan: <input type='text' name='jurusan[]' required><br><br>";
            }
            ?>
            <input type="submit" value="Simpan">
            <input type="reset" value="Batal">
        </form>
    <?php
    } 
    // Kalau data siswa sudah diisi, tampilkan tabel hasilnya
    else {
        $nisn    = $_POST['nisn'];
        $nama    = $_POST['nama'];
        $jurusan = $_POST['jurusan'];

        // Gabungkan data pakai array_map
        $dataSiswa = array_map(function($i, $n, $j) {
            return ["nisn" => $i, "nama" => $n, "jurusan" => $j];
        }, $nisn, $nama, $jurusan);

        echo "<h2>Hasil Input Data Siswa</h2>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>No</th><th>NISN</th><th>Nama</th><th>Jurusan</th></tr>";
        foreach ($dataSiswa as $s => $siswa) {
            echo "<tr>";
            echo "<td>".($s+1)."</td>";
            echo "<td>".$siswa['nisn']."</td>";
            echo "<td>".$siswa['nama']."</td>";
            echo "<td>".$siswa['jurusan']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
</body>
</html>
