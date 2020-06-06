<?php 
error_reporting(0);
session_start();
include "../koneksi.php";
include "../fungsi/fungsi.php";

$sesiadmin = $_SESSION['owner'];
if(!isset($sesiadmin)){
    header('location: index.php');
}

$admin = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_admin WHERE id_admin = '$sesiadmin'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita Mahasiswa</title>
    <link rel="stylesheet" href="../assets/css/style.css" type="text/css">
</head>
<body>

    <div id="container">
    
    <div class="header">
            <h1>Admin - Portal Berita Mahasiswa</h1>
            <p>Berita terkini dan terupdate dikalangan mahasiswa</p>
        </div>
        <div class="menu">
            <ul>
                <li><a href="home.php" title="Home">Home</a></li>
                <li><a href="berita.php" title="Berita">Berita</a></li>
                <li><a href="logout.php" title="Login">Logout</a></li>
            </ul>
        </div>
        
        <div class="konten">
            <div class="konten-kiri">  
            <h1>IKLAN</h1> 
            <a href="inputiklan.php" title="Tambah iklan">Tambah Iklan</a>

            <!-- Menampilkan berita -->
            <table border="1" width="100%">
            <thead>
                <tr>
                <th>Nama Perusahaan</th>
                <th>Tanggal Iklan</th>
                <th>Deskripsi</th>
                <th>Link</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Actions</th>   
            </thead>
            <tbody>
            
            <?php
            $sql = mysqli_query($connect, "SELECT * FROM tb_iklan, tb_admin 
            WHERE tb_iklan.id_admin = tb_admin.id_admin");
            while($row = mysqli_fetch_array($sql)){
                ?>

            <tr>
            <td><?= $row['nm_perusahaan'];?></td>
            <td><?= format_tgl1($row['tgl_mulai']);?> - <?= format_tgl1($row['tgl_selesai']);?></td>
            <td><?= $row['isi_iklan'];?></td>
            <td><?= $row['link'];?></td>
            <td><?= $row['status'];?></td>
            <td><img src="../assets/images/iklan/<?= $row['gambar'];?>" style="width:100px; height:100px;"></td>
            <td><a href="editiklan.php?id=<?= $row['id_iklan'];?>" title="Edit">Edit</a> 
            <a href="hapusiklan.php?id=<?= $row['id_iklan'];?>" title="Hapus">Hapus</a></td>
            </tr>
            <?php  }  ?>
            </tbody>
            </table>

            </div>
            <div class="konten-kanan"></div>
            <div style="clear:both;"></div>
        </div>
    </div>
<?php include "../footer.php"; ?>
</body>
</html>