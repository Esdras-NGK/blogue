<?php
// Connexion à la base de données via PDO
$connection = new PDO("mysql:host=localhost;dbname=article", "root", "");

$mode_edition = 0; // Initialisation du mode d'édition à 0 (par défaut)

// Vérification si le formulaire d'édition a été soumis
if (isset($_POST['edit']) && !empty($_POST['edit'])) {
    $mode_edition = 1; // Passage en mode édition

    // Récupération et sécurisation de l'ID de l'article à éditer
    $edit_id = strip_tags($_POST['edit']);
    // Préparation et exécution de la requête pour récupérer les informations de l'article
    $edit_article = $connection->prepare('SELECT * FROM jeu WHERE id = ?');
    $edit_article->execute(array($edit_id));

    // Vérification si l'article existe
    if ($edit_article->rowCount() == 1) {
        $edit_article = $edit_article->fetch(); // Récupération des données de l'article
    } else {
        die('Erreur : l\'article n\'existe pas'); // Message d'erreur si l'article n'existe pas
    }
} else {
    // Message d'erreur si les champs ne sont pas remplis
    $message = 'Veuillez remplir les champs';
    echo "Veuillez remplir les champs";
}

// Vérification si les champs du formulaire sont remplis
if (isset($_POST['Titrearticle'], $_POST['nomarticle'])) {
    if (!empty($_POST['Titrearticle']) && !empty($_POST['nomarticle'])) {
        // Récupération et sécurisation des valeurs des champs
        $Titrearticle = strip_tags($_POST['Titrearticle']);
        $nomarticle = strip_tags($_POST['nomarticle']);

        // Vérification du mode (création ou édition)
        if ($mode_edition == 0) {
            // Insertion d'un nouvel article
            $ins = $connection->prepare('INSERT INTO jeu (titre, contenu, publication) VALUES (?, ?, NOW())');
            $ins->execute(array($Titrearticle, $nomarticle));
            $message = 'Votre article a bien été posté';

            // Redirection vers la page des articles
            header('Location: ../articlejeu.php');
            exit();
        } else {
            // Mise à jour d'un article existant (il semble y avoir une erreur ici, car il s'agit d'une insertion)
            $ins = $connection->prepare('INSERT INTO jeu (titre, contenu, publication) VALUES (?, ?, NOW())');
            $ins->execute(array($Titrearticle, $nomarticle));
            $message = 'Votre article a bien été posté';

            // Redirection vers la page des articles
            header('Location: ../articlejeu.php');
            exit();
        }
    } else {
        $message = 'Veuillez remplir les champs'; // Message d'erreur si les champs sont vides
    }
} else {
    // Message d'erreur si les champs ne sont pas envoyés
    $message = 'Veuillez remplir les champs';
    echo "Veuillez remplir les champs";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
          <a class="navbar-brand">Navbar</a>
          <div class="d-flex">
            <a href="" class="nav-link active me-2">ACCUEIL</a>
            <a href="" class="nav-link active me-2">A PROPOS</a>
            <a href="" class="nav-link active me-2">CONTACT</a>
          </div>
        </div>
    </nav>

    <header class="hero-header text-white" style="background-color: black; color: #f1f1f1;">
        <div style=" background: url(FTJOPMAUsAQSfEm.jpg); opacity: 0.5;" class="jumbotron bg-cover text-white; background-size: cover;">
            <div class="container py-5 text-center">
                <h1 class="display-4 font-weight-bold">Votre achat</h1>
                <p class="font-italic mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus deleniti sit facere officia temporibus non doloremque tempore esse aliquid quidem. Consequatur et dicta, voluptatum id dolorum iusto cupiditate quos corrupti.</p>
                <p class="font-italic">Snippet by <a href="" class="text-white"><u>Esdras</u></a></p>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <section class="col-8 p-4" id="section" style="display: flex;flex-direction: row;flex-wrap: wrap;">
                <div class="row">
                    <!-- Contenu supplémentaire ici -->
                </div>
            </section>

            <article class="col-4 p-4">
                <div>
                    <div class="row bg-light" style="padding: 4%;">
                        <button id="cat"><h1>catégories</h1></button>
                        <div id="cube" style="background-color: #f1f1f1;">
                            <a href="ecran.php" id="p3">Ecran</a><br>
                            <a href="jeu.php" id="p3">Playstation 5</a>
                        </div>
                    </div>

                    <div class="row bg-light" style="padding: 4%;">
                        <h1>article récent</H1>
                        <p>article</p>
                    </div>
                </div>
            </article>

            <div class="formul" style="margin:auto; width: 100%;">
                <form action='php/result.php' method="post" style="padding: 0% 12%;">
                    <div class="bas">
                        <label for="Titrearticle">titre d'article</label>
                        <input type="text" id="Titrearticle" name="Titrearticle" placeholder="Titre article" <?php if($mode_edition == 1) {?> value="<?=$edit_article['titre'] ?>"<?php } ?> />

                        <label for="nomarticle">description</label>
                        <textarea name="nomarticle" id="nomarticle" cols="30" rows="10" placeholder="description"><?php if($mode_edition == 1) {?> <?=$edit_article['contenu'] ?><?php } ?></textarea>
                        <label for="image">image</label>
                        <input type="file" id="image" name="image" placeholder="image">
                    </div>
                    <input type="submit" value="envoyer">
                </form> 
                <br>
                <?php if(isset($message)) {echo $message; }; ?>
            </div>
        </div>


        




    </div>

    <footer class="text-center text-white" style="background-color: #f1f1f1;">
        <div class="container pt-4">
            <section class="mb-4">
                <a href="" class="p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58 6.32 6.32 0 0 1 0 13.542a9.29 9.29 0 0 0 5.031 1.472"/>
                    </svg>
                </a>
            </section>
        </div>

        <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
</body>
</html>
