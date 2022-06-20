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
    <div class='bg-banniere text-align-center padding-top-70 teko size-25  padding-bottom-100'>
        <h1 class="black">Ajouter un cours</h1>
        <div class=' small-80 large-50 margin-auto border-radius-10 padding-100-0 margin-50-0 flex justify-center'>
            <form class='padding-top-50 padding-bottom-50 grid text-align-center' method="POST" action="#" id="form_profil">
                <p style="color:red" data-id="thematique"></p>
                <div class="flex justify-center margin-bottom-30">
                <label class=" small-100 medium-100 small-center medium-center" for="thematique">Thematique :</label>
                <input data-table="cours" class="auto-save" type="text" name="thematique" id="thematique" value="<?= $C->thematique ?>">
                </div>
                <p style="color:red" data-id="prix"></p>
                <div class="flex justify-center margin-bottom-30">
                <label class=" small-100 medium-100 small-center medium-center" for="prix">Prix :</label>
                <input data-table="cours" class="auto-save" type="number" id="prix" name="prix" min="0" required value="<?= $C->prix ?>"><br><br>
                </div>
                <p style="color:red" data-id="Niveau"></p>
                <div class="flex justify-center margin-bottom-30">
                <label  class=" small-100 medium-100 small-center medium-center" for="niveau">Niveau :</label>
                <select data-table="cours" class="auto-save" name="niveau" id="niveau">
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="expert">Expert</option>
                </select>
                </div>
                <p style="color:red" data-id="detail"></p>
                <div class="flex justify-center margin-bottom-30">
                <label class=" small-100 medium-100 small-center medium-center" for="detail">Détail :</label>
                <textarea data-table="cours" class="auto-save" name="detail" id="detail" cols="30" rows="10"><?= $C->detail ?></textarea>
                </div>
                <p style="color:red" data-id="motcles"></p>
                <div class="flex justify-center margin-bottom-30">
                <label class="small-100 medium-100 small-center medium-center text-align-ini">Mots clés :</label>
                <div class="mots-cles"></div>
                
                <div>
                    <input type="text" name="motcles" id="saisie-mots" value="" />
                    
                    <span id="ajouter-mot">+</span><br><br>
                    </div>
                </div>
                
                <input id="hidden" type="hidden" value="<?= $C->id() ?>">
                <div class= align-center>
                <input class='btn' type="submit" value="Valider">
            </div>
            </form>
        </div>
    </div>
    <!--Début Footer-->
    <footer class="c-333 teko flex container justify-center small-center">
        <div class="c-333 large-33 display-inline-grid justify-center small-100">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="<?= $ROOT ?>/js/modif_cours.js"></script>

</body>

</html>