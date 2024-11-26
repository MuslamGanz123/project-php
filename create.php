<!DOCTYPE html> <!-- Menandakan bahwa dokumen ini adalah HTML5 -->
<html>
<head>
    <title>Form Pendaftaran Peserta</title> <!-- Judul halaman yang ditampilkan di tab browser -->
    <!-- Menghubungkan halaman dengan file CSS dari Bootstrap untuk styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container"> <!-- Membuat kontainer Bootstrap untuk mengatur layout -->
    <?php
    // Mengimpor file koneksi untuk menghubungkan ke database
    include "koneksi.php";

    // Fungsi untuk membersihkan inputan dari pengguna
    function input($data) {
        $data = trim($data); // Menghapus spasi di awal dan akhir string
        $data = stripslashes($data); // Menghapus backslashes dari string
        $data = htmlspecialchars($data); // Mengubah karakter khusus menjadi entitas HTML
        return $data; // Mengembalikan data yang telah dibersihkan
    }

    // Memeriksa apakah ada kiriman form dari metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Mengambil dan membersihkan data dari form
        $nama = input($_POST["nama"]);
        $sekolah = input($_POST["sekolah"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $alamat = input($_POST["alamat"]);

        // Query untuk memasukkan data ke dalam tabel peserta
        $sql = "insert into peserta (nama, sekolah, jurusan, no_hp, alamat) values ('$nama', '$sekolah', '$jurusan', '$no_hp', '$alamat')";

        // Menjalankan query di atas
        $hasil = mysqli_query($kon, $sql);

        // Memeriksa apakah query berhasil dieksekusi
        if ($hasil) {
            header("Location:index.php"); // Mengarahkan ke halaman index.php jika berhasil
        } else {
            // Menampilkan pesan kesalahan jika gagal
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data</h2> <!-- Judul untuk bagian input data -->

    <!-- Form untuk mengumpulkan data peserta -->
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group"> <!-- Grup untuk input nama -->
            <label>Nama:</label> <!-- Label untuk input nama -->
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required /> <!-- Input untuk nama -->
        </div>
        <div class="form-group"> <!-- Grup untuk input sekolah -->
            <label>Sekolah:</label> <!-- Label untuk input sekolah -->
            <input type="text" name="sekolah" class="form-control" placeholder="Masukan Nama Sekolah" required/> <!-- Input untuk sekolah -->
        </div>
        <div class="form-group"> <!-- Grup untuk input jurusan -->
            <label>Jurusan :</label> <!-- Label untuk input jurusan -->
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" required/> <!-- Input untuk jurusan -->
        </div>
        <div class="form-group"> <!-- Grup untuk input no HP -->
            <label>No HP:</label> <!-- Label untuk input no HP -->
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/> <!-- Input untuk no HP -->
        </div>
        <div class="form-group"> <!-- Grup untuk input alamat -->
            <label>Alamat:</label> <!-- Label untuk input alamat -->
            <textarea name="alamat" class="form-control" rows="5" placeholder="Masukan Alamat" required></textarea> <!-- Textarea untuk alamat -->
        </div>       

        <button type="submit" name="submit" class="btn btn-primary">Submit</button> <!-- Tombol untuk mengirimkan form -->
    </form>
</div>
</body>
</html>