<?php
error_reporting(0);
session_start();
include "../koneksi.php";

$id = mysqli_real_escape_string($connect, $_GET['id']);
$ceknama = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tb_iklan WHERE id_iklan='$id'"));
$namagambar =$ceknama['gambar'];

unlink('../assets/images/iklan/' . $namagambar);
$sql = mysqli_query($connect, "DELETE FROM tb_iklan WHERE id_iklan='$id'"); //hapus dari tabel

if($sql){
    echo "<script>alert('Hapus berhasil'); document.location='iklan.php'</script>";
}else{
    echo "<script>alert('Hapus gagal'); document.location='iklan.php'</script>";
}
?>