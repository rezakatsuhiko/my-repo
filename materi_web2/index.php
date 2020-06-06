<?php 
error_reporting(0);
session_start();

include "koneksi.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Berita Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>
<body>

    <div id="container">
        <?php include "header.php"; ?>
        <div class="konten">
            <div class="konten-kiri">
                <h2>BERITA TERBARU</h2>
                <?php

                $data=mysqli_query($connect,"SELECT * FROM tb_berita, tb_admin where tb_berita.id_admin=tb_admin.id_admin order by id_berita desc");
                while ($row = mysqli_fetch_array($data)) {
                
                ?>
                <div class="feedberita">
                    <img src="assets/images/berita/<?= $row['gambar'];?>" alt="<?= $row['judul'];?>" style="width: 250px; height: 150px; float: left; margin: 10px;">
                <a href=""><h3><?= $row['judul'];?></h3></a>
                <hr>
                <p><?= substr($row['text_berita'],0,150);?>...<a href="#">Baca Selengkapnya</a></p>
                <p>Diposting oleh : <?= $row['nama_lengkap'];?>, Tanggal : <?= $row['tgl_posting'];?></p>  
                </div>
                <br>
                <?php } ?>

            </div>
            <div class="konten-kanan">

                <?php
                $sesiadmin = $_SESSION['member'];
                if(isset($sesiadmin)){
                    $anggota = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_anggota WHERE id_anggota = '$sesiadmin'"));
                        ?>
                        <h3>Menu Anggota</h3>
                        <ul>
                        <li><a href="anggota/ubahbiodata.php">Ubah Biodata & Password</a></li>
                        <li><a href="anggota/logout.php">Logout</a></li>
                        </ul>
            <?php
            }
            ?>
            
            <hr>
            <h3>Advertising</h3>
             <?php

                $data=mysqli_query($connect,"SELECT * FROM tb_iklan, tb_admin WHERE tb_iklan.id_admin=tb_admin.id_admin AND tb_iklan.status = 'Aktif' ORDER BY id_iklan DESC");
                while ($row = mysqli_fetch_array($data)) {
                
                ?>
                <img src="assets/images/iklan/<?= $row['gambar'];?>" alt="<?= $row['nm_perusahaan'];?>" style="width: 60%; height: 200px;">
                <a href="<?= $row['link'];?>"><h3><?= $row['nm_perusahaan'];?></h3></a>
                <hr>
                <p><?= $row['isi_iklan'];?></p>
                <br>
                <?php } ?>

            </div>
            <div style="clear:both;"></div>
        </div>
        <?php include "footer.php"; ?>
    
</body>
</html>