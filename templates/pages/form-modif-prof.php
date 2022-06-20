<?php
global $ROOT;
?>
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
    <div>
        <div class='bg-banniere text-align-center padding-top-70 padding-bottom-100 teko size-25'>
            <h1 class="width-100 padding-top-70 padding-bottom-50">Modification du profil</h1>
            <div class=' bg-ffffff85 margin-auto large-50 margin-auto border-radius-10 padding-100-0 margin-50-0 flex medium-block small-block'>
                <div class="large-60 medium-100 small-100">
                    <form class='padding-top-50 padding-bottom-50' method="POST" action="#" id="form_profil">
                        <div class="justify-center margin-bottom-30">
                            <p style="color:red" data-id="telephone"><?= isset($V->getErrors()["telephone"]) ? $V->getErrors()["telephone"][0] : "" ?></p>
                            <div class="flex justify-center">
                                <label for="telephone">Téléphone :</label>
                                <input data-table="general" class="auto-save width-30 border-radius-10 medium-width-50 small-width-50" type="tel" id="telephone" name="telephone" required value="<?= $P->utilisateur->telephone ?>">
                            </div>
                        </div>
                        <div class="justify-center margin-bottom-30">
                            <p style="color:red" data-id="nom"><?= isset($V->getErrors()["nom"]) ? $V->getErrors()["nom"][0] : "" ?></p>
                            <div class="flex justify-center">
                                <label for="nom">Nom :</label>
                                <input data-table="general" class="auto-save width-30 border-radius-10 medium-width-50 small-width-50" type="text" id="nom" name="nom" required value="<?= $P->utilisateur->nom ?>">
                            </div>
                        </div>
                        <div class="justify-center margin-bottom-30">
                            <p style="color:red" data-id="prenom"><?= isset($V->getErrors()["prenom"]) ? $V->getErrors()["prenom"][0] : "" ?></p>
                            <div class="flex justify-center">
                                <label for="prenom">Prénom :</label>
                                <input data-table="general" class="auto-save width-30 border-radius-10 medium-width-50 small-width-50" type="text" id="prenom" name="prenom" required value="<?= $P->utilisateur->prenom ?>">
                            </div>
                        </div>
                        <div class="margin-bottom-30">
                            <p style="color:red" data-id="diplome"><?= isset($V->getErrors()["diplome"]) ? $V->getErrors()["diplome"][0] : "" ?></p>
                            <div class="flex justify-center">
                                <label for="diplome">Diplôme :</label>
                                <select data-table="profil" class="auto-save width-30 border-radius-10 medium-width-50 small-width-50" name="diplome" id="diplome">
                                    <?php include "templates/fragments/select-diplome.php" ?>
                                </select>
                            </div>
                        </div>
                        <div class="margin-bottom-30">
                            <p style="color:red" data-id="pro"><?= isset($V->getErrors()["pro"]) ? $V->getErrors()["pro"][0] : "" ?></p>
                            <div class="flex justify-center">
                                <label>Êtes vous professionnel ? </label>
                                <?php include "templates/fragments/select-pro.php" ?>
                            </div>
                        </div>
                        <div>
                            <div class="margin-bottom-30">
                                <?php include "templates/fragments/siret.php" ?>
                            </div>
                        </div>
                        <div class="margin-bottom-30">
                            <p style="color:red" data-id="description"><?= isset($V->getErrors()["description"]) ? $V->getErrors()["description"][0] : "" ?></p>
                            <div class="flex justify-center">
                                <label for="description">Description :</label><br>
                                <textarea data-table="profil" class="auto-save width-30 border-radius-10 medium-width-50 small-width-50" name="description" id="description" cols="30" rows="10"><?= $P->description ?></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="margin-bottom-30">
                        <p class="text-align-center">Mes disponibilités :</p>
                        <table class="table-dispo">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Lun</th>
                                    <th>Mar</th>
                                    <th>Mer</th>
                                    <th>Jeu</th>
                                    <th>Ven</th>
                                    <th>Sam</th>
                                    <th>Dim</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>Matin</th>
                                    <td class="<?= $dispo["lundi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["mardi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["mercredi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["jeudi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["vendredi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["samedi"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["dimanche"]["am"] == 1 ? "dispo" : "" ?>"></td>
                                </tr>
                                <tr>
                                    <th>A-M</th>
                                    <td class="<?= $dispo["lundi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["mardi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["mercredi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["jeudi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["vendredi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["samedi"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["dimanche"]["pm"] == 1 ? "dispo" : "" ?>"></td>
                                </tr>
                                <tr>
                                    <th>Soir</th>
                                    <td class="<?= $dispo["lundi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["mardi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["mercredi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["jeudi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["vendredi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["samedi"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                    <td class="<?= $dispo["dimanche"]["ev"] == 1 ? "dispo" : "" ?>"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button disabled id="mesdispos">Enregistrer</button>
                    </div>
                </div>
                <div class="large-40 medium-100 small-100">
                    <div class="photo-profil" style="background-image: url('<?= asset("uploads/") ?><?= $P->get("photo") ? $P->get("photo") : "defaut.png" ?>'); background-size: <?= $P->get("zoom") ? $P->get("zoom") : "100" ?>%; background-position-x: <?= $P->get("pos_x") ? $P->get("pos_x") : "0" ?>px;background-position-y: <?= $P->get("pos_y") ? $P->get("pos_y") : "0" ?>px;">
                    </div>
                    <?= $P->get("photo") ? '<a class="btn btn_redim" href=' . $ROOT . '/prive/ajustement_photo/' . $P->id() . '>Redimensionner votre photo</a>' : "" ?>
                    <form class='padding-top-50 padding-bottom-50' method="post" action="<?= $ROOT ?>/prive/envoi_photo/" enctype="multipart/form-data">
                        <div class="flex justify-center margin-bottom-30">
                            <label>Votre photo de profil</label>
                            <input type="file" name="photo" accept="image/*" />
                            <input type="submit" value="Ajouter la photo" />
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <div>
            <h2>Mes cours</h2>
            <div class="justify-center">
                <?php
                //pour chaque cours on les affiches
                foreach ($listeCours as $cours) {
                ?>
                    <a class="decoration-none font-size-40 c-333 teko font-weight-semi-bold" href="<?= $ROOT ?>/prive/ajout_cours/<?= $cours->id() ?>"><?= ($cours->get("thematique") !== "" or $cours->get("thematique") != NULL) ?  $cours->get("thematique") : "Mon cours"  ?></a>
                <?php
                }
                ?>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="<?= $ROOT ?>/js/profil_prof.js"></script>

</html>