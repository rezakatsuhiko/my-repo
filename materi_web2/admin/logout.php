<?php
error_reporting(0);
session_start();

unset($_SESSION['owner']);
unset($_SESSION['webportal']);

session_destroy();

header('location:index.php');
?>