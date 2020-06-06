<?php
error_reporting(0);
session_start();

unset($_SESSION['member']);
unset($_SESSION['webanggota']);

session_destroy();

header('location:../index.php');
?>