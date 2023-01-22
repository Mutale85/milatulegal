<?php include("../includes/db.php")?>
<?php include("../includes/base.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
    include("header.php");
    $phonenumber = $_SESSION['phonenumber'];
    $client_id =  $_SESSION['userId'];
  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include("top_nav.php")?>

        <?php include("side_nav.php")?>

        <div class="content-wrapper">
            <?php include("content_head.php")?>
        
            <section class="content">