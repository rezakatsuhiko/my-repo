<?php 
error_reporting(0);
session_start();
include "../koneksi.php";

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
            <?php include "menu.php"; ?>
        </div>
        
        <div class="konten">
            <div class="konten-kiri">  
            <h1>DAFTAR ANGGOTA</h1> 

            <!-- Menampilkan berita -->
            <table border="1" width="100%">
            <thead>
                <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>   
            </thead>
            <tbody>
            
            <?php
            $sql = mysqli_query($connect, "SELECT * FROM tb_anggota");
            while($row = mysqli_fetch_array($sql)){
                ?>

            <tr>
            <td><?= $row['nama'];?></td>
            <td><?= $row['email'];?></td>
            <td><?= $row['status'];?></td>

            <?php
            if($row['status'] == 'Aktif'){
                ?>
            <td><a href="blokiranggota.php?id=<?= $row['id_anggota'];?>" title="Blokir">Blokir</a> 
            <a href="hapusanggota.php?id=<?= $row['id_anggota'];?>" title="Hapus">Hapus</a></td>
            
            <?php 
            }else{
                ?>
            <td><a href="bukablokiranggota.php?id=<?= $row['id_anggota'];?>" title="Buka Blokir">Buka Blokir</a> 
            <a href="hapusanggota.php?id=<?= $row['id_anggota'];?>" title="Hapus">Hapus</a></td>

                <?php 
            }
            ?>

            </tr>
            <?php  }  ?>
            </tbody>
            </table>

            </div>
            <div class="konten-kanan"></div>
            <div style="clear:both;"></div>
        </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>