<?php


$connection = new PDO("mysql:host=localhost;dbname=article;charset=utf8","root","");


if(isset($_GET['id']) and !empty($_GET['id'])){
  

  $supp_id = htmlspecialchars($_GET['id']);

  $supp = $connection->prepare('DELETE FROM tele WHERE id = ?');
  $supp->execute(array($supp_id));

  header('Location: articletele.php');
  exit();
}



?>