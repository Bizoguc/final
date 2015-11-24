<?php
session_start(); ob_start();

if($_SESSION['status']=='User'){
     header("Location: index.php");
     exit;
}else if($_SESSION['status']== null){
   header("Location: login.php");
     exit;
}
?>