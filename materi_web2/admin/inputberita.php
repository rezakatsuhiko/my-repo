<?php 
error_reporting(0);
session_start();
include "../koneksi.php";

$sesiadmin = $_SESSION['owner'];
if(!isset($sesiadmin)){
    header('location: index.php');
}

$admin = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_admin WHERE id_admin = '$sesiadmin'"));

$judul = mysqli_real_escape_string($connect, $_POST['judul']);       //judul
$isi = mysqli_real_escape_string($connect, $_POST['isi']);           //deskripsi
$kategori = mysqli_real_escape_string($connect, $_POST['kategori']); //kategori

$foto = $_FILES['gambar']['tmp_name'];                              //temporary
$namafoto = $_FILES['gambar']['name'];                             //nama gambar
$tgl = date('Y-m-d H:i:s');

$ext = strtolower(end(explode(".", $namafoto)));
$namabaru = $judul .'.'. $ext;

if(isset($_POST['submit'])){
    if($judul == ""){
        $judul_error = "<span style= 'color: red;'> Judul wajib diisi </span>";
    }
    elseif($kategori == ""){
        $kategori_error = "<span style= 'color: red;'> Kategori wajib diisi </span>";
    }
    elseif($isi == ""){
        $isi_error = "<span style= 'color: red;'> Deskripsi wajib diisi </span>";
    }
    elseif(empty($foto)){
        $gambar_error = "<span style= 'color: red;'> Gambar wajib diisi </span>";
    }else{
        // simpan gambar ke dalam folder berita
        move_uploaded_file($foto, '../assets/images/berita/'.$namabaru);
        // simpan data ke database
    
    
    $sql = mysqli_query($connect, "INSERT INTO tb_berita (judul, text_berita, id_admin, id_kategori, tgl_posting, dilihat, gambar)
                                   VALUES('$judul','$isi','$sesiadmin','$kategori','$tgl','1','$namabaru')");
    if($sql){
        echo "<script>alert('Input berhasil'); document.location='berita.php'</script>";
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
            <?php include "menu.php"; ?>
        </div>
        
        <div class="konten">
            <div class="konten-kiri">  
            <h1>TAMBAH BERITA</h1> 
           
            <form action="" method="POST" enctype="multipart/form-data">
                <table>
                <tr>
                <td>Judul Berita</td>
                <td>
                    <input type="text" name="judul" placeholder="Masukan Judul" class="input" value="<?= $judul; ?>">
                    <?= $judul_error;?>
                </tr></td>
                <tr>
                <td>Kategori Berita</td>    
                <td>
                    <select name="kategori">
                    <option value=""> -- Pilih Kategori -- </option>
                    <?php
                    $sql = mysqli_query($connect, "SELECT * FROM tb_kategori");
                    while($row = mysqli_fetch_array($sql)){
                        if($row['id_kategori'] == $kategori){
                    ?>        
                    <option value="<?= $row['id_kategori'];?>" selected="selected"><?= $row['kategori'];?></option>   
                    <?php }else{
                        ?> 
                        <option value="<?= $row['id_kategori'];?>"><?= $row['kategori'];?></option> 
                    <?php }
                    } ?>
                        
                    </select>
                    <?= $kategori_error;?>
                </tr></td>
                <tr>
                <td>Deskripsi Berita</td>
                <td>
                    <textarea name="isi" rows="4" cols="40" placeholder="isi berita"><?= $isi; ?></textarea>
                    <?= $isi_error;?>
                </td>
                </tr>
                <tr>
                <td>Sampul Berita</td>    
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