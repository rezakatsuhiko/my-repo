<?php
error_reporting(0);
session_start();
include "../koneksi.php";

$id = mysqli_real_escape_string($connect, $_GET['id']);
$sql = mysqli_query($connect, "DELETE FROM tb_anggota WHERE id_anggota='$id'"); //hapus dari tabel

if($sql){
    echo "<script>alert('Hapus berhasil'); document.location='anggota.php'</script>";
}else{
    echo "<script>alert('Hapus gagal'); document.location='anggota.php'</script>";
}
?>