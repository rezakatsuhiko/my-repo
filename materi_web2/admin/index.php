<?php 
error_reporting(0);
session_start();
include "../koneksi.php";

$sesiadmin = $_SESSION['owner'];
if(isset($sesiadmin)){
    header('location: home.php');
}


$user = $_POST['user'];
$pass = $_POST['pass'];

$passmd5 = md5($pass);

if(isset($_POST['submit'])){
    if($user == ""){
        $user_error = "<span style= 'color: #FFF;'> User wajib diisi </span>";
    }
    elseif($pass == ""){
        $pass_error = "<span style= 'color: #FFF;'> Password wajib diisi </span>";
    }
    else{
        $cekadmin = mysqli_query($connect, "SELECT * FROM tb_admin WHERE username = '$user' AND password = '$passmd5'");
        $row = mysqli_fetch_array($cekadmin);
        $idadmin = $row['id_admin']; //id admin dari tb admin
        $ada = mysqli_num_rows($cekadmin);
        
        if($ada > 0){
            $_SESSION['webportal'] = $user;
            $_SESSION['owner'] = $idadmin; //jadikan session
            echo "<script>alert('Selamat Datang !'); document.location= 'home.php'</script>";
        }
        else{
            $pass_error = "<span style= 'color: #FFF;'> Username atau Password Salah </span>";
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
    
    <?php include "../header.php"; ?>
        
        <div class="konten">
            <div class="konten-kiri">  
                <form action="" method="POST">
                <table class="login" >
                <tr><th> 
                    <h2>LOGIN ADMIN</h2>                        
                    </th></tr>
                <tr><td>
                    <input type="text" name="user" placeholder="Masukan User Admin" class="input" value="<?= $user; ?>">
                    <?= $user_error;?>
                </tr></td>
                <tr><td>
                    <input type="password" name="pass" placeholder="Masukan Password Admin" class="input" >
                    <?= $pass_error;?>
                </tr></td>
                <tr><td>
                    <button type="submit" name="submit">LOGIN </a> </button> 
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