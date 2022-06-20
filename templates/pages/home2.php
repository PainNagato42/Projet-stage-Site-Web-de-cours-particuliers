<?php global $ROOT; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $ROOT ?>/css/css.css">
    <title>Document</title>
</head>
<body>
    <?php print_r($_SESSION) ?>
    <h1>Accueil</h1>
    <p>test des fonctionnalités</p>
    <form method="post" action="<?= $ROOT ?>/public/liste_cours_rechercher/">
        <input type="search" name="filtre" id="filtre">
        <select name="niveau" id="niveau">
            <option value="all">Tout niveau</option>
            <option value="debutant">Débutant</option>
            <option value="intermediaire">Intermediaire</option>
            <option value="Expert">Expert</option>
        </select>
        <div>
            <input type="checkbox" value="1" id="connecte" name="connecte">
            <label for="connecte">En ligne</label>
        </div>
        <input type="submit" value="rechercher">
    </form>
    <div id="theme"><p id="theme_libelle"></p></div>
    <?php
    if(isset($_SESSION) AND $_SESSION == []) { ?>
        <p><a href="<?= $ROOT ?>/public/choix_role/">S'inscrire</a></p>
    <?php } 
     ?>
    
    <?php
        if(isset($_SESSION) AND $_SESSION == []){ ?>
            <p><a href="<?= $ROOT ?>/public/connexion/">Se connecter</a></p>
        <?php }
     ?>
    <?php
        if(isset($_SESSION["connected"]) AND $_SESSION["connected"] == true){ ?>
            <p><a href="<?= $ROOT ?>/public/deconnexion/">Se déconnecter</a></p>
        <?php }
     ?>
     <?php
        if(isset($_SESSION["connected"]) AND $_SESSION["connected"] == true){ 
            if($_SESSION["role"] == "eleve"){ ?>
                <p><a href="<?= $ROOT ?>/public/modif_profil/">Modifier votre profil</a></p>
            <?php } else if($_SESSION["role"] == "prof") { ?>
                <p><a href="<?= $ROOT ?>/public/modif_profil_prof/">Modifier votre profil</a></p>
            <?php } ?>
         <?php }
     ?>
     <?php
        if(isset($_SESSION["connected"]) AND $_SESSION["connected"] == true) {
            if($_SESSION["role"] == "prof") { ?>
                <p><a href="<?= $ROOT ?>/prive/affiche_form_cours/">Ajouter un cours</a></p>
             <?php } 
        }  
     ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="<?= $ROOT ?>/js/home.js"></script>
</body>

</html>