<?php


$connection = new PDO("mysql:host=localhost;dbname=article;charset=utf8","root","");


// if(isset($_GET['edit']) and !empty($_GET['edit'])){
  

//   $edit_id = htmlspecialchars($_GET['edit']);

//   $Udp = $connection->prepare('UPDATE jeu SET titre =? , contenu = ?, date_time_edition = NOW() WHERE id = ?');
//   $Udp->execute(array($edit_id));

//   header('Location: articlejeu.php');
//   exit();
// }

// $mode_edition = 0;

// if(isset($_GET['edit']) and !empty($_GET['edit'])){
// //   $mode_edition = 1;


//   $edit_id = strip_tags($_GET['edit']);
//   $edit_article = $connection->prepare('SELECT * FROM jeu WHERE id = ?');
//   $edit_article->execute(array($edit_id));




//   if($edit_article->rowCount() ==1)
//   {
//     $edit_article = $edit_article->fetch();

    
//   }
//   else{
//     die('Erreur : l\'article n\'existe pas');
//   }
// }
// else{
//   $message = 'Veillez remplir les champs';
//   echo "Veillez remplir les champs";
// }





if(isset($_GET['edit']) and !empty($_GET['edit'])){
  if(isset($_POST['Titrearticle'], $_POST['nomarticle'])){

    if(!empty($_POST['Titrearticle']) AND !empty($_POST['nomarticle'])){

      $edit_id = htmlspecialchars($_GET['edit']);
      $Titrearticle = strip_tags($_POST['Titrearticle']);
      $nomarticle = strip_tags($_POST['nomarticle']);



      $update = $connection->prepare("UPDATE jeu SET titre =? , contenu = ?, date_time_edition = NOW() WHERE id = ?");

      

      $update->execute(array($Titrearticle, $nomarticle, $edit_id));



      if ($update->rowCount() > 0) {
        // La mise à jour a été effectuée avec succès
        echo "Mise à jour réussie.";
        $message = 'Votre article a bien été mis à jour?id='.$edit_id;
    
        header('Location: ../articlejeu.php');
        exit();
      } else {
          // Aucune ligne n'a été modifiée
          echo "Aucune mise à jour effectuée.";
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

}






?>



