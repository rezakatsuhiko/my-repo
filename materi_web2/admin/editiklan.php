<?php 
error_reporting(0);
session_start();
include "../koneksi.php";

$sesiadmin = $_SESSION['owner'];
if(!isset($sesiadmin)){
    header('location: index.php');
}

$admin = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_admin WHERE id_admin = '$sesiadmin'"));

$id = mysqli_real_escape_string($connect, $_GET['id']);
$b = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_iklan WHERE id_iklan='$id'"));


$judul = mysqli_real_escape_string($connect, $_POST['judul']);           //judul
$isi = mysqli_real_escape_string($connect, $_POST['isi']);               //deskripsi
$tglmulai = mysqli_real_escape_string($connect, $_POST['mulai']);        //tanggal mulai
$tglselesai = mysqli_real_escape_string($connect, $_POST['selesai']);    //tanggal selesai
$link = mysqli_real_escape_string($connect, $_POST['link']);             //link
$status = mysqli_real_escape_string($connect, $_POST['status']);         //Status
$gambarlama = mysqli_real_escape_string($connect, $_POST['gambarlama']); //nama gambar lama

$foto = $_FILES['gambar']['tmp_name'];                              //temporary
$namafoto = $_FILES['gambar']['name'];                              //nama gambar
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
    else{
        if(empty($foto)){   //kalau fotonya tidak diganti
            $sql = mysqli_query($connect, "UPDATE tb_iklan SET nm_perusahaan = '$judul', isi_iklan = '$isi', tgl_mulai = '$tglmulai', tgl_selesai = '$tglselesai', link = '$link', status = '$status' WHERE id_iklan = '$id'");
            if($sql){
                echo "<script>alert('Edit berhasil'); document.location='iklan.php'</script>";
            }else{
                $gambar_error = "<span style= 'color: red;'> Terjadi kesalahan sistem, silahkan coba lagi</span>";
            }
        } else{
            unlink('../assets/images/iklan/' . $gambarlama);
            
            // simpan gambar ke dalam folder berita
            move_uploaded_file($foto, '../assets/images/iklan/'.$namabaru);
            
            // simpan data ke database
            $sql = mysqli_query($connect, "UPDATE tb_iklan SET gambar = '$namabaru', nm_perusahaan = '$judul', isi_iklan = '$isi', tgl_mulai = '$tglmulai', tgl_selesai = '$tglselesai', link = '$link', status = '$status' WHERE id_iklan = '$id'");
            if($sql){
                echo "<script>alert('Edit berhasil'); document.location='iklan.php'</script>";
            }else{
                $gambar_error = "<span style= 'color: red;'> Terjadi kesalahan sistem, silahkan coba lagi</span>";
            }
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
            <?php include "menu.php"; ?>
        </div>
        
        <div class="konten">
            <div class="konten-kiri">  
            <h1>EDIT IKLAN</h1> 
           
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                <tr>
                <td>Judul Iklan</td>
                <td>
                    <input type="text" name="judul" placeholder="Masukan Judul" class="input" value="<?= $b['nm_perusahaan']; ?>">
                    <?= $judul_error;?>
                </tr>
                </td>
                <tr>
                <td>Tanggal Mulai</td>
                <td>
                    <input type="date" name="mulai" placeholder="Tanggal Mulai" class="input" value="<?= $b['tgl_mulai']; ?>">
                    <?= $tglmulai_error;?>
                </tr>
                </td>
                <tr>
                <td>Tanggal Selesai</td>
                <td>
                    <input type="date" name="selesai" placeholder="Tanggal Selesai" class="input" value="<?= $b['tgl_selesai']; ?>">
                    <?= $tglselesai_error;?>
                </tr>
                </td>
                <tr>
                <td>Deskripsi Iklan</td>
                <td>
                    <textarea name="isi" rows="4" cols="40" placeholder="Isi Iklan"><?= $b['isi_iklan']; ?></textarea>
                    <?= $isi_error;?>
                </td>
                </tr>
                <tr>
                <td>Link Iklan</td>
                <td>
                    <input type="text" name="link" placeholder="Link Iklan" class="input" value="<?= $b['link']; ?>">
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
                <td>Status Iklan</td>    
                <td>
                    <select name="status">
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
                    </select>
                </td>
                </tr>
                <tr>
                <td>&nbsp;</td><td>
                <input type="hidden" name="gambarlama" value="<?= $b['gambar']; ?>">
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