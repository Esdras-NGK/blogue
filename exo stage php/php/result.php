<?php


$connection = new PDO("mysql:host=localhost;dbname=article","root","");

$mode_edition = 0;

if(isset($_POST['edit']) and !empty($_POST['edit'])){
  $mode_edition = 1;

  $edit_id = strip_tags($_POST['edit']);
  $edit_article = $connection->prepare('SELECT * FROM jeu WHERE id = ?');
  $edit_article->execute(array($edit_id));


  if($edit_article->rowCount()==1){
    $edit_article = $edit_article->fetch();


  }
  else{
    die('Erreur : l\'article n\'existe pas');
  }
}
else{
  $message = 'Veillez remplir les champs';
  echo "Veillez remplir les champs";
}


if(isset($_POST['Titrearticle'], $_POST['nomarticle'])){
  if(!empty($_POST['Titrearticle']) AND !empty($_POST['nomarticle'])){
    $Titrearticle = strip_tags($_POST['Titrearticle']);
    $nomarticle = strip_tags($_POST['nomarticle']);

    // if($Titrearticle != ""){

    // }


    if($mode_edition == 0){




      

      $ins = $connection->prepare('INSERT INTO jeu (titre,contenu,publication	) VALUES (?,?,NOW())');
      $ins->execute(array($Titrearticle, $nomarticle));
      $message = 'Votre article a bien été posté';

      
      header('Location: ../articlejeu.php');
      exit();
      
    }
    else{
      $update = $connection->prepare('UPDATE jeu SET titre= ?, contenu = ?, date_time_edition = NOW() WHERE id = ? ');
      $update->execute(array($Titrearticle, $nomarticle, $edit_id));
      $message = 'Votre article a bien été mis à jour';

      header('Location: ../articlejeu.php');
      exit();





    }

    
      

    
 
    
  }
  else{
    $message = 'Veillez remplir les champs';
  }
}
else{
  $message = 'Veillez remplir les champs';
  echo "Veillez remplir les champs";
}



?>


