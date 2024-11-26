<!DOCTYPE html> <!-- Menandakan bahwa dokumen ini adalah HTML5 -->
<html>
<head>
    <!-- Menghubungkan halaman dengan file CSS dari Bootstrap untuk styling -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>
    Glenn salomo <!-- Judul halaman yang ditampilkan di tab browser -->
</title>
<body>
    <!-- Navbar dengan tema gelap -->
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">Muhammad Almuslam</span> <!-- Menampilkan nama sebagai brand -->
    </nav>
    
    <div class="container"> <!-- Kontainer Bootstrap untuk mengatur layout -->
        <br>
        <h4><center>DAFTAR CALON PESERTA</center></h4> <!-- Judul tabel peserta -->
        
        <?php
        // Mengimpor file koneksi untuk menghubungkan ke database
        include "koneksi.php";

        // Memeriksa apakah ada parameter 'id_peserta' dalam URL
        if (isset($_GET['id_peserta'])) {
            // Mengambil dan membersihkan ID peserta dari URL
            $id_peserta = htmlspecialchars($_GET["id_peserta"]);

            // Query untuk menghapus data peserta berdasarkan ID
            $sql = "delete from peserta where id_peserta='$id_peserta'";
            // Menjalankan query
            $hasil = mysqli_query($kon, $sql);

            // Memeriksa apakah query berhasil dieksekusi
            if ($hasil) {
                header("Location:index.php"); // Mengarahkan ke halaman index.php jika berhasil
            } else {
                // Menampilkan pesan kesalahan jika gagal
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
            }
        }
        ?>
        
        <br>
        <table class="my-3 table table-bordered"> <!-- Tabel untuk menampilkan data peserta -->
            <thead>
                <tr class="table-primary"> <!-- Baris header tabel -->
                    <th>No</th>
                    <th>Nama</th>
                    <th>Sekolah</th>
                    <th>Jurusan</th>
                    <th>No Hp</th>
                    <th>Alamat</th>
                    <th colspan='2'>Aksi</th> <!-- Kolom untuk aksi (Update dan Delete) -->
                </tr>
            </thead>

            <?php
            // Mengimpor file koneksi untuk menghubungkan ke database
            include "koneksi.php";
            // Query untuk mengambil semua data peserta dari tabel
            $sql = "select * from peserta order by id_peserta desc";
            // Menjalankan query
            $hasil = mysqli_query($kon, $sql);
            $no = 0; // Inisialisasi nomor urut

            // Mengambil data peserta satu per satu
            while ($data = mysqli_fetch_array($hasil)) {
                $no++; // Increment nomor urut
            ?>
            <tbody>
                <tr>
                    <td><?php echo $no; ?></td> <!-- Menampilkan nomor urut -->
                    <td><?php echo $data["nama"]; ?></td> <!-- Menampilkan nama peserta -->
                    <td><?php echo $data["sekolah"]; ?></td> <!-- Menampilkan sekolah peserta -->
                    <td><?php echo $data["jurusan"]; ?></td> <!-- Menampilkan jurusan peserta -->
                    <td><?php echo $data["no_hp"]; ?></td> <!-- Menampilkan nomor HP peserta -->
                    <td><?php echo $data["alamat"]; ?></td> <!-- Menampilkan alamat peserta -->
                    <td>
                        <!-- Tombol untuk mengupdate data peserta -->
                        <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                        <!-- Tombol untuk menghapus data peserta -->
                        <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php
            }
            ?>
        </table>
        <!-- Tombol untuk menambah data peserta baru -->
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>
</html>