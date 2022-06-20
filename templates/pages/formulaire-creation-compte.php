<?php global $ROOT; ?>
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
    <div class='bg-banniere height-750  text-align-center padding-top-70 padding-bottom-100 teko size-25'>
        <h1 class="width-100 padding-top-70 padding-bottom-50">Choisissez votre rôle</h1>
        <div class=' bg-ffffff85 margin-auto large-50 margin-auto border-radius-10 padding-100-0 margin-50-0 medium-block small-block'>
            <form class='padding-top-50 padding-bottom-50' method="POST" action="<?= $ROOT ?>/public/creation_compte/">
            <div class="flex justify-center margin-bottom-30">
                <p style="color:red"> <?= isset($V->getErrors()["pseudo"]) ? $V->getErrors()["pseudo"][0] : "" ?> </p>
                <label for="pseudo">Pseudo :</label>
                <input class="width-30 border-radius-10 medium-width-50 small-width-50" type="text" id="pseudo" name="pseudo" value="<?= isset($_POST["pseudo"]) ? $_POST["pseudo"] : "" ?>" required>
                </div>
                <div class="flex justify-center margin-bottom-30">
                <p style="color:red"> <?= isset($V->getErrors()["email"]) ? $V->getErrors()["email"][0] : "" ?> </p>
                <label for="email">Email :</label>
                <input class="width-30 border-radius-10 medium-width-50 small-width-50"  type="email" id="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>" required>
                </div>
                <div class="flex justify-center margin-bottom-30">
                <p style="color:red"> <?= isset($V->getErrors()["password"]) ? $V->getErrors()["password"][0] : "" ?> </p>
                <label for="password">Mot de passe :</label>
                <input class="width-30 border-radius-10 medium-width-50 small-width-50"  type="password" id="password" name="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>" required>
                <input type="hidden" value="<?php if (isset($_GET["id"])) {
                                                if (isset($_POST["role"])) {
                                                    echo $_POST["role"];
                                                } else {
                                                    echo $_GET["id"];
                                                }
                                            }  ?>" name="role">
                                            </div>
                <input class="btn" type="submit" value="Créer le compte">
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