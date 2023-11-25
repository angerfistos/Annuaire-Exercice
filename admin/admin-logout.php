<?php 
$title = "Admin-logout";
session_start();
session_destroy();
header('Location: ../index.php');
exit;
?>