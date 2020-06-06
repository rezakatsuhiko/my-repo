<?php 
error_reporting(0);
session_start();
include "koneksi.php";

$sesiadmin = $_SESSION['member'];
if(isset($sesiadmin)){
    header('location: home.php');
}


$user = mysqli_real_escape_string($connect, $_POST['user']);  //input email
$pass = mysqli_real_escape_string($connect, $_POST['pass']);  //input password
$nama = mysqli_real_escape_string($connect, $_POST['nama']);  //input nama

$passmd5 = md5($pass); //password yang di enkripsi MD5

if(isset($_POST['submit'])){
    if($nama == ""){
        $nama_error = "<span style= 'color: #FFF;'> Nama wajib diisi </span>";
    }elseif($user == ""){
        $user_error = "<span style= 'color: #FFF;'> Email wajib diisi </span>";
    }
    elseif($pass == ""){
        $pass_error = "<span style= 'color: #FFF;'> Password wajib diisi </span>";
    }
    else{   
        $cekemail = mysqli_query($connect, "SELECT * FROM tb_anggota WHERE email = '$user'");
        $ada = mysqli_num_rows($cekemail);
        if($ada > 0){
            $user_error = "<span style= 'color: #FFF;'> Email sudah terdaftar </span>";
        }else{
            $sql = mysqli_query($connect, "INSERT INTO tb_anggota (nama,email,password,status) VALUES
            ('$nama','$user','$passmd5','Aktif')");
            if($sql){
                echo "<script>alert('Selamat! Anda berhasil menjadi anggota, Silahkan Login'); document.location= 'index.php'</script>";
            }else{
                echo "<script>alert('Gagal! terjadi kesalahan, silahkan ulangi kembali'); document.location= 'index.php'</script>";
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
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>
<body>

    <div id="container">
    
    <?php include "header.php"; ?>
        
        <div class="konten">
            <div class="konten-kiri">  
                <form action="" method="POST">
                <table class="login" >
                <tr><th> 
                    <h2>DAFTAR ANGGOTA</h2>                        
                    </th></tr>
                <tr><td>
                    <input type="text" name="nama" placeholder="Masukan Nama Lengkap" class="input" value="<?= $nama; ?>" maxlength="60">
                    <?= $nama_error;?>
                </tr></td>    
                <tr><td>
                    <input type="text" name="user" placeholder="Masukan Email" class="input" value="<?= $user; ?>"maxlength="60">
                    <?= $user_error;?>
                </tr></td>
                <tr><td>
                    <input type="password" name="pass" placeholder="Masukan Password" class="input" maxlength="15">
                    <?= $pass_error;?>
                </tr></td>
                <tr><td>
                    <button type="submit" name="submit">Daftar</a></button> 
                </tr></td>
                <tr><td>
                    <a href="anngota/index.php" title="Login" style="color: #FFF;">Klik untuk Login Anggota</a>
                </td>
                </tr>
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