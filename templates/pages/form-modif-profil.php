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
        <h1 class="width-100 padding-top-70 padding-bottom-50">Modification profil</h1>
        <div class=' bg-ffffff85 margin-auto large-50 margin-auto border-radius-10 padding-100-0 margin-50-0'>
            <form  class='padding-top-50 padding-bottom-50' method="POST" action="#" id="form_profil">
            <div class="flex justify-center margin-bottom-30">
                <p style="color:red" data-id="telephone"><?= isset($V->getErrors()["telephone"]) ? $V->getErrors()["telephone"][0] : "" ?></p>
                <label for="telephone">Téléphone :</label>
                <input data-table="general" class="auto-save width-30 border-radius-10" type="tel" id="telephone" name="telephone" required value="<?= $U->html("telephone") ?>">
            </div>
                <div class="flex justify-center margin-bottom-30">
                <p style="color:red" data-id="nom"><?= isset($V->getErrors()["nom"]) ? $V->getErrors()["nom"][0] : "" ?></p>
                <label for="nom">Nom :</label>
                <input data-table="general" class="auto-save width-30 border-radius-10" type="text" id="nom" name="nom" required value="<?= $U->html("nom") ?>">
                </div>
                <div class="flex justify-center margin-bottom-30">
                <p style="color:red" data-id="prenom"><?= isset($V->getErrors()["prenom"]) ? $V->getErrors()["prenom"][0] : "" ?></p>
                <label for="prenom">Prénom :</label>
                <input data-table="general" class="auto-save width-30 border-radius-10" type="prenom" id="prenom" name="prenom" required value="<?= $U->html("prenom") ?>">
                </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="<?= $ROOT ?>/js/ajax.js"></script>

</html>