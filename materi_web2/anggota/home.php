<?php 
error_reporting(0);
session_start();
include "../koneksi.php";

$sesianggota = $_SESSION['owner'];
if(!isset($sesianggota)){
    header('location: index.php');
}

$anggota = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_anggota WHERE id_anggota = '$sesianggota'"));
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
            <h1>Anggota - Portal Berita Mahasiswa</h1>
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
            <h1>Selamat Datang <?= $anggota['nama'];?> [<?= $anggota['id_anggota'];?>] di ruang Anggota !</h1> 

            </div>
            <div class="konten-kanan"></div>
            <div style="clear:both;"></div>
        </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>