<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "templates/fragments/head.php" ?>
    <title></title>

</head>

<body>
    <?php include "templates/fragments/header.php" ?>
    <h2>Liste des cours recherchés avec le contenu "<?= isset($_GET["filtre"]) ? $_GET["filtre"] : "" ?>"</h2>
    <div class="flex justify-center container margin-bottom-30">
        <?php
        foreach ($liste as $cours) {

            include "templates/fragments/carte_cours.php";
        }
        ?>
    </div>

    <div>
        <?php
        for ($i = 1; $i<= $pages; $i++) {
        ?>
            <a class="page" href="<?= $ROOT ?>/public/liste_cours_rechercher/page_<?= $i ?>?filtre=<?= $_GET["filtre"] ?>&niveau=<?= $_GET["niveau"] ?>&connecte=<?= isset($_GET['connecte']) ? $_GET["connecte"] : 0 ?>" title="lien vers lap age suivante">page <?= $i ?></a>
        <?php
        }

        ?>
    </div>
</body>

</html>