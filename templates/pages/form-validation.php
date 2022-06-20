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
    <div class='bg-banniere padding-190-0  text-align-center padding-top-70 teko size-25'>
        <h1>Valider votre email</h1>
        <div class=' bg-ffffff85 large-50 margin-auto border-radius-10 padding-100-0 margin-50-0'>
            <form class='padding-top-50 padding-bottom-50' method="POST" action="<?= $ROOT ?>/public/traitement_validation/<?= $_GET["id"] ?>">
                <label class="grid" for="email">Email</label>
                <input type="email" id="email" name="email"><br><br>
                <input class="btn margin-top-0" type="submit" value="Valider">
            </form>
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