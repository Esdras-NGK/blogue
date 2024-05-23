<?php


$connection = new PDO("mysql:host=localhost;dbname=article","root","");

$mode_edition = 0;

if(isset($_GET['edit']) and !empty($_GET['edit'])){
  $mode_edition = 1;

  $edit_id = htmlspecialchars($_GET['edit']);
  $edit_article = $connection->prepare('SELECT * FROM tele WHERE id = ?');
  $edit_article->execute(array($edit_id));

  if($edit_article->rowCount()==1){
    $edit_article = $edit_article->fetch();
  }
  else{
    die('Erreur : l\'article n\'existe pas');
  }
}


if(isset($_POST['Titrearticle'], $_POST['nomarticle'])){
  if(!empty($_POST['Titrearticle']) AND !empty($_POST['nomarticle'])){
    $Titrearticle = htmlspecialchars($_POST['Titrearticle']);
    $nomarticle = htmlspecialchars($_POST['nomarticle']);


    if($mode_edition == 0){

      // var_dump($_FILES);
      // var_dump(exif_imagetype($_FILES['miniature']['tmp_name']));

      $ins = $connection->prepare('INSERT INTO tele (titre,contenu,publication	) VALUE (?,? NOW()');
      $ins->execute(array($Titrearticle, $nomarticle));
      $message = 'Votre article a bien été posté';

      $lastid= $bdd->lastInsertId();


      if(isset($_FILES['miniature']) AND !empty($_FILES['miniature']['name'])){
        if(exif_imagetype($_FILES['miniature']['tmp_name']) ==2){
          $chemin = 'miniature/'.$lastid.'.jpg';
          move_uploaded_file($_FILES['miniature']['tmp_name'], $chemin);
        } else{
          $message = 'Votre image doit etre au format jpg' ;
        }
      }
      else{
        echo "erreur veillez entre une image";
      }
      
      

      
      
      
    }
    else{
      $update = $connection->prepare('UPDATE tele SET titre= ?, contenu = ?, date_time_edition = NOW() WHERE id = ? ');
      $update->execute(array($Titrearticle, $nomarticle, $edit_id));
      $message = 'Votre article a bien été mis à jour';

    }
      // extract($_POST);

    
      header('Location: ../articletele.php');
      exit();

    
 
    
  }
  else{
    $message = 'Veillez remplir les champs';
  }
}
?>