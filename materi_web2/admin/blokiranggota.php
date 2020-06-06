<?php
error_reporting(0);
session_start();
include "../koneksi.php";

$id = mysqli_real_escape_string($connect, $_GET['id']);
$sql = mysqli_query($connect, "UPDATE tb_anggota SET status='Tidak Aktif' WHERE id_anggota = $id");

if($sql){
    echo "<script>alert('Blokir berhasil'); document.location='anggota.php'</script>";
}else{
    echo "<script>alert('Blokir gagal'); document.location='anggota.php'</script>";
}
?>