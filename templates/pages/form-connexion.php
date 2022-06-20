<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include "templates/fragments/head.php" ?>
    <title>Document</title>
</head>

<body >
    <!--Début header-->
    <?php include "templates/fragments/header.php" ?>
    <!--Fin header-->
    <div class='bg-banniere  padding-top-70 teko size-25'>
            <h1 class="black">Se connecter</h1>
            <div class='large-50 margin-auto border-radius-10 padding-100-0 margin-50-0 small-80'>
            <form class='padding-top-50 padding-bottom-50' method="POST" action="<?= $ROOT ?>/public/connecte/">
                <div class="flex justify-center margin-bottom-30">
                <label class="small-100 medium-100 small-center medium-center" for="email">Email :</label>
                <input  type="email" name="email" id="email" />
                </div>
                <div class="flex justify-center margin-bottom-30">
                <label class="small-100 medium-100 small-center medium-center" for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" />
</div>
                <p><?= isset($erreur) ? $erreur : "" ?></p>
                <div class="text-align-center">
                <input class="btn" type="submit" value="se connecter" />
                </div>
            </form>
        </div>
    </div>
    <!--Début Footer-->
    <footer class="c-333 teko flex container justify-center small-center">
            <div class="c-333 large-33 display-inline-grid justify-center small-100" >
                <p class="size-30 bold">A propos</p>
                <a class="c-333 decoration-none" href="" alt="Lien vers Qui somme-nous">Qui sommes-nous</a>
                <a class="c-333 decoration-none" href="" alt="Lien vers Nos valeur">Nos valeurs</a>
                <a class="c-333 decoration-none" href="" alt="Lien vers Mention légals">Mentions légales</a>
                <a class="c-333 decoration-none" href="" alt="Lien vers Confidentialité">Confidentialité</a>
                <a class="c-333 decoration-none" href="" alt="Lien vers Crédits">Crédits</a>
            </div>
            <div class="large-33 grid justify-center justify-item-center small-100">
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
            <div class="large-33 display-inline-grid justify-center small-100">
                <p class="size-30 bold">Assistance</p>
                <a class="c-333 decoration-none" href="" alt="Lien vers Centre d'aide">Centre d'aide</a>
                <a class="c-333 decoration-none" href="" alt="Lien vers Contact">Contact</a>
            </div>
        </footer>
        <!--Fin Footer-->
</body>

</html>