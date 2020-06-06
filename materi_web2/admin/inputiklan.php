<?php 
error_reporting(0);
session_start();
include "../koneksi.php";

$sesiadmin = $_SESSION['owner'];
if(!isset($sesiadmin)){
    header('location: index.php');
}

$admin = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_admin WHERE id_admin = '$sesiadmin'"));

$judul = mysqli_real_escape_string($connect, $_POST['judul']);            //judul
$isi = mysqli_real_escape_string($connect, $_POST['isi']);                //deskripsi
$tglmulai = mysqli_real_escape_string($connect, $_POST['mulai']);         //tanggal mulai
$tglselesai = mysqli_real_escape_string($connect, $_POST['selesai']);     //tanggal selesai
$link = mysqli_real_escape_string($connect, $_POST['link']);              //link

$foto = $_FILES['gambar']['tmp_name'];                              //temporary
$namafoto = $_FILES['gambar']['name'];                             //nama gambar
$tgl = date('Y-m-d H:i:s');

$ext = strtolower(end(explode(".", $namafoto)));
$namabaru = $judul .'.'. $ext;

if(isset($_POST['submit'])){
    if($judul == ""){
        $judul_error = "<span style= 'color: red;'> Judul wajib diisi </span>";
    }
    elseif($tglmulai == ""){
        $tglmulai_error = "<span style= 'color: red;'> Tanggal wajib diisi </span>";
    }
    elseif($tglselesai == ""){
        $tglselesai_error = "<span style= 'color: red;'> Tanggal wajib diisi </span>";
    }
    elseif($isi == ""){
        $isi_error = "<span style= 'color: red;'> Deskripsi wajib diisi </span>";
    }
    elseif(empty($foto)){
        $gambar_error = "<span style= 'color: red;'> Gambar wajib diisi </span>";
    }else{
        // simpan gambar ke dalam folder berita
        move_uploaded_file($foto, '../assets/images/iklan/'.$namabaru);
        // simpan data ke database
    
    $sql = mysqli_query($connect, "INSERT INTO tb_iklan (nm_perusahaan, isi_iklan, id_admin, tgl_mulai, tgl_selesai, link, gambar, status)
                                   VALUES('$judul','$isi','$sesiadmin','$tglmulai','$tglselesai','$link','$namabaru','Aktif')");
    if($sql){
        echo "<script>alert('Input berhasil'); document.location='iklan.php'</script>";
    }else{
        $gambar_error = "<span style= 'color: red;'> Terjadi kesalahan sistem, silahkan coba lagi</span>";
    }
    }
}    
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
                <li><a href="iklan.php" title="Iklan">Iklan</a></li>
                <li><a href="" title="Anggota">Anggota</a></li>
                <li><a href="logout.php" title="Login">Logout</a></li>
            </ul>
        </div>
        
        <div class="konten">
            <div class="konten-kiri">  
            <h1>TAMBAH IKLAN</h1> 
           
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                <tr>
                <td>Judul Iklan</td>
                <td>
                    <input type="text" name="judul" placeholder="Masukan Judul" class="input" value="<?= $judul; ?>">
                    <?= $judul_error;?>
                </tr>
                </td>
                <tr>
                <td>Tanggal Mulai</td>
                <td>
                    <input type="date" name="mulai" placeholder="Tanggal Mulai" class="input" value="<?= $tglmulai; ?>">
                    <?= $tglmulai_error;?>
                </tr>
                </td>
                <tr>
                <td>Tanggal Selesai</td>
                <td>
                    <input type="date" name="selesai" placeholder="Tanggal Selesai" class="input" value="<?= $tglselesai; ?>">
                    <?= $tglselesai_error;?>
                </tr>
                </td>
                <tr>
                <td>Deskripsi Iklan</td>
                <td>
                    <textarea name="isi" rows="4" cols="40" placeholder="Isi Iklan"><?= $isi; ?></textarea>
                    <?= $isi_error;?>
                </td>
                </tr>
                <tr>
                <td>Link Iklan</td>
                <td>
                    <input type="text" name="link" placeholder="Link Iklan" class="input" value="<?= $link; ?>">
                    <?= $link_error;?>
                </tr>
                </td>
                <tr>
                <td>Gambar Iklan</td>    
                <td>
                    <input type="file" name="gambar" accept=".jpg, .png, .JPEG, .JPG, .PNG">
                    <?= $gambar_error;?>
                </td>
                </tr>
                <tr>
                <td>&nbsp;</td>
                <td>
                    <button type="submit" name="submit">SIMPAN</a> </button> 
                </tr></td>
                </table>
                </form>

            </div>
            <div class="konten-kanan"></div>
            <div style="clear:both;"></div>
        </div>
    </div>
<?php include "footer.php"; ?>
</body>
</html>