<?php include("head.php");?>
<?php include("pdo.php");?>
<?php


    include 'pdo.php';

    $result = $pdo->query("DELETE FROM `favori` WHERE id_fav= ".$_GET['favori'].";");
    $favori = $result->fetch(PDO::FETCH_ASSOC);
    header('Location: index.php');
    exit();
    
?>
 