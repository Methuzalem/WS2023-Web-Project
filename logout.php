<?php
session_start();
$_SESSION['rolle'] = "anonym";
header("location:home.php");
die();
?>