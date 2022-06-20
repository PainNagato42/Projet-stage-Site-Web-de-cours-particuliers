<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "templates/fragments/head.php" ?>
    <title>Document</title>
</head>

<body>
    <!--Début header-->
    <?php include "templates/fragments/header.php" ?>
    <!--Fin header-->
    <div class="medium-center padding-top-100 bg-banniere padding-bottom-100">
        <h1 class="width-100 padding-bottom-50">Choisissez votre rôle</h1>
        <div class="flex justify-center">
            <div class="width-20 block text-align-center small-100">
                <a href="<?= $ROOT ?>/public/inscription/3" class="block decoration-none uppercase teko c-333 font-size-30 padding-top-50 font-weight-bold">
                <img src="<?= $ROOT ?>/image/eleve.png" alt="Illustration d'un élève" class="width-80 height-80 border-radius-30 zoom"></a>
                <a href="<?= $ROOT ?>/public/inscription/3" class="block decoration-none uppercase teko c-333 font-size-30 padding-top-50 font-weight-bold">Élève</a>
            </div>

            <div class="width-20 block text-align-center small-100">
            <a href="<?= $ROOT ?>/public/inscription/2" class="block decoration-none uppercase teko c-333 font-size-30 padding-top-50 font-weight-bold">
            <img src="<?= $ROOT ?>/image/professeur.png" alt="Illustration d'un professeur" class="width-80 height-80 border-radius-30 zoom"></a>
                <a href="<?= $ROOT ?>/public/inscription/2" class="block decoration-none uppercase teko c-333 font-size-30 padding-top-50 font-weight-bold">Prof</a>
            </div>
        </div>
    </div>
    <!--Début Footer-->
    <footer class="c-333 teko flex container justify-center">
        <div class="c-333 large-33 display-inline-grid justify-center">
            <p class="size-30 bold">A propos</p>
            <a class="c-333 decoration-none" href="" alt="Lien vers Qui somme-nous">Qui sommes-nous</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Nos valeur">Nos valeurs</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Mention légals">Mentions légales</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Confidentialité">Confidentialité</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Crédits">Crédits</a>
        </div>
        <div class="large-33 grid justify-center justify-item-center">
            <p class="size-30 bold">Suivez-nous</p>
            <div class="flex">
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="Lien vers Facebook">
                    <i class="bi bi-facebook"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="Lien vers twitter">
                    <i class="bi bi-twitter"></i>
                </a>
                <a class="c-333 decoration-none margin-right-10 small-100 margin-left-60" href="" alt="lien vers instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a class="c-333 decoration-none small-100 margin-left-60" href="" alt="lien vers linkdin">
                    <i class="bi bi-linkedin"></i>
                </a>
            </div>
        </div>
        <div class="large-33 display-inline-grid justify-center">
            <p class="size-30 bold">Assistance</p>
            <a class="c-333 decoration-none" href="" alt="Lien vers Centre d'aide">Centre d'aide</a>
            <a class="c-333 decoration-none" href="" alt="Lien vers Contact">Contact</a>
        </div>
    </footer>
    <!--Fin Footer-->
</body>

</html>