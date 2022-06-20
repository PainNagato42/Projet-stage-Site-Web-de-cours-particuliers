<?php global $ROOT; ?>
<!DOCTYPE html>
<html>

<head>
    <?php include "templates/fragments/head.php" ?>
    <title></title>
</head>

<body>
    <!--Début header-->
    <?php include "templates/fragments/header.php" ?>
    <!--Fin header-->
    <!--Début bannière-->
    <div class="bg-banniere flex medium-center padding-top-70">
        <div class="small-banniere medium-banniere banniere">
            <p class="fredericka font-size-40 color-fff">Vous voulez enrichir vos connaissances ?</p>
            <p class="teko color-fff font-size-40 letter-spacing-10 small-spacing-5 medium-spacing-5 medium-size-35">Trouvez direct le prof qu'il vous faut !</p>
            <form class="flex justify-center medium-jus-center-normal" method="get" action="<?= $ROOT ?>/public/liste_cours_rechercher/page_1">
                <div class="relative">
                    <input class="border-radius-10 border-none margin-right-15 padding-0-80 small-padding-10-30 medium-padding-10-70" type="search" placeholder="Recherchez votre cours..." name="filtre" id="filtre" autocomplete="off">
                    <div id="theme"></div>
                </div>
                <div class="relative">
                    <input class="border-radius-10 border-none margin-right-15 padding-0-80 bg-blanc" id="btn_filtre" type="button" value="Filtre">
                    <!-- POPUP pour le filtre -->
                    <div class="border-radius-10 popup_filtre">
                        <select name="niveau" id="niveau">
                            <option value="">Tout niveau</option>
                            <option value="debutant">Débutant</option>
                            <option value="intermediaire">Intermediaire</option>
                            <option value="Expert">Expert</option>
                        </select>
                        <div>
                            <input type="checkbox" value="1" id="connecte" name="connecte">
                            <label for="connecte">En ligne</label>
                        </div>
                    </div>
                </div>
                <div>
                    <input class="border-radius-10" id="btn_recherche" type="submit" value="" />
                </div>
            </form>

        </div>
        <div class="large-40 display-none medium-none"><img src="<?= asset("image/image-banniere.png") ?>" alt="image de deux personnes communiquant sur un réseau de cours particulier"></div>
    </div>
    <!--Fin bannière-->
    <!-- Debut Nos cours les plus suivis-->
    <div class="container ">
        <h2>Nos cours les plus suivis</h2>
        <div class="flex">
            <!-- Carte des 8 les plus suivis -->
            <?php
            foreach ($liste as $cours) {
                include "templates/fragments/carte_cours.php";
            }
            ?>

        </div>
    </div>
    <!--Fin nos cours les plus suivis-->
    <!--Début de l'annuaire francophone de recherche de cours en ligne-->
    <div class="padding-top-100">
        <div class="bg-annuaire padding-top-100 padding-bottom-100">
            <h1>
                L'annuaire francophone
                de recherche <br> de cours en ligne</h1>
            <h3 class="margin-bottom-150">Quelque soit le domaine, sélectionnez votre
                professeur particulier parmi nos profs certifiés</h3>

            <div class="podium flex padding-bottom-100">
                <div class=" relative left justify-center align-item-center teko font-weight-bold color-fff font-size-40 border-radius-podium small-podium">
                    <div class="photo-profil bottom-100 absolute small-podium" style="background-image: url('/image/image-professeur.png'); background-size: 110%; background-position-x: 0%;background-position-y: 0%;">
                        <img class="medaille" src="/image/medaille-or.png">
                    </div>
                    <span class="teko" id="second">2</span>
                </div>
                <div class=" relative top justify-center align-item-center teko font-weight-bold color-fff font-size-40 border-radius-podium small-podium">
                    <div class="photo-profil absolute bottom-100 small-podium" style="background-image: url('/image/image-professeur.png'); background-size: 110%; background-position-x: 0%;background-position-y: 0%;">
                        <img class="medaille" src="/image/medaille-or.png">
                    </div>
                    <span class="teko" id="premier">1</span>
                </div>
                <div class=" relative right justify-center align-item-center teko font-weight-bold color-fff font-size-40 border-radius-podium small-podium">
                    <div class="photo-profil absolute bottom-100 small-podium" style="background-image: url('/image/image-professeur.png'); background-size: 110%; background-position-x: 0%;background-position-y: 0%;">
                        <img class="medaille" src="/image/medaille-or.png">
                    </div>
                    <span class="teko" id="troisieme">3</span>
                </div>
            </div>

            <!--Fin de l'annuaire francophone de recherche de cours en ligne-->
            <!--Début de Comment ça marche ?-->
            <div class="container bg-blanc border-radius-100">
                <h4>
                    Comment ça marche ?</h4>
                <div class="flex">
                    <div class="large-50 flex align-item-center padding-150 small-100">
                        <p class="eraserdust size-25">1. Inscrivez-vous Lorem Ipsum is simply dummy
                            text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard
                            dummy text ever since the 1500s</p>
                    </div>
                    <div class="large-50 justify-center flex align-item-center display-none"><img src="<?= asset("image/illustration2violet.png") ?>" alt="image dynamique" class=" medium-100"> </div>
                </div>
                <div class="flex">
                    <div class="large-50 justify-center flex align-item-center small-100"><img src="<?= asset("image/illustration2violet.png") ?>" alt="image dynamique" class="small-100 medium-100"> </div>
                    <div class="large-50 flex align-item-center padding-150 small-100">
                        <p class="eraserdust size-25">2. Recherchez le cours qui vous
                            intéresse parmis la sélection
                            de tout nos Prof DirectLore
                            Ipsum is simply dummy text of
                            the printing and typesetting industry.
                        </p>
                    </div>

                </div>
                <div class="flex">
                    <div class="large-50 flex align-item-center padding-150 small-100">
                        <p class="eraserdust size-25">3. Sélectionner votre prof direct que
                            vous aurez trouver le plus à votre
                            convenanceLorem Ipsum is Simply

                        </p>
                    </div>
                    <div class="large-50 justify-center flex align-item-center display-none"><img src="<?= asset("image/illustration2violet.png") ?>" alt="image dynamique" class=" medium-100"> </div>
                </div>
                <div class="flex">
                    <div class="large-50 justify-center flex align-item-center small-100"><img src="<?= asset("image/illustration2violet.png") ?>" alt="image dynamique" class="small-100 medium-100"> </div>
                    <div class="large-50 flex align-item-center padding-150 small-100">
                        <p class="eraserdust size-25">4. Acheter vos jetons afin de
                            pouvoir commencer votre cours direct
                            pouvoir commencer votre cours direct
                            pouvoir commencer votre cours direct</p>
                    </div>

                </div>
                <div class="flex">
                    <div class="large-50 flex align-item-center padding-150 small-100">
                        <p class="eraserdust size-25">5. Réserver votre séance Lorem Ipsum
                            is simply dummy text of the
                            printing and typesetting industry.
                            Lorem Ipsum has been the industry's</p>
                    </div>
                    <div class="large-50 justify-center flex align-item-center display-none"><img src="<?= asset("image/illustration2violet.png") ?>" alt="image dynamique" class="medium-100"> </div>
                </div>
            </div>
        </div>
        <!--Fin de Comment ça marche ?-->
        <!--debut Acheter des crédits-->
        <h2 id="achat_points">Acheter des crédits</h2>
        <!--1000 crédit-->
        <div class="flex container">

            <div class="large-33 flex justify-center small-100 medium-50 zoom">
                <a class="decoration-none c-333" href="<?= $ROOT ?>/prive/achat_point/1" alt="lien de redirection vers l'achat de 10000 Crédits">
                    <div class="bg-blanc margin-bottom-70  ombrage-carte border-radius-10 roboto padding-bottom-20 margin-top-70 grid justify-center justify-item-center">
                        <img class="large-90" src="<?= asset("image/1000-credit.png") ?>" alt="Illustration montrant un crédit">
                        <p class="padding-bottom-20">Crédits : 1000</p>
                        <p>Prix : 10 €</p>
                    </div>
                </a>
            </div>

            <!--5000 crédit-->
            <div class="large-33 flex justify-center small-100 medium-50 zoom">
                <a class="decoration-none c-333" href="<?= $ROOT ?>/prive/achat_point/2" alt="lien de redirection vers l'achat de 10000 Crédits">
                    <div class="bg-blanc teko margin-bottom-70  ombrage-carte border-radius-10 roboto padding-bottom-20 margin-top-70 grid justify-center justify-item-center">
                        <img class="large-90" src="<?= asset("image/1000-credit.png") ?>" alt="Illustration montrant un crédit">
                        <p class="padding-bottom-20">Crédits : 5000 + 500 Offerts</p>
                        <p>Prix : 50 €</p>
                    </div>
                </a>
            </div>
            <!--10000 crédit-->

            <div class="large-33 flex justify-center small-100 medium-100 zoom">
                <a class="decoration-none c-333" href="<?= $ROOT ?>/prive/achat_point/3" alt="lien de redirection vers l'achat de 10000 Crédits">
                    <div class="bg-blanc margin-bottom-70  ombrage-carte border-radius-10 roboto padding-bottom-20 margin-top-70 grid justify-center justify-item-center">
                        <img class="large-90" src="<?= asset("image/1000-credit.png") ?>" alt="Illustration montrant un crédit">
                        <p class="padding-bottom-20">Crédits : 10000 + 1000 Offerts</p>
                        <p>Prix : 100 €</p>
                    </div>
                </a>
            </div>
        </div>
        <!--Fin Acheter des crédits-->
        <!--Début Vous avez une question ?-->
        <div class="bg-formulaire padding-bottom-100">
            <h2 class="padding-bottom-50">
                Vous avez une question ?
            </h2>
            <form class="container bg-blanc-2 border-radius-10 box-shadow-30-30-6 padding-75 padding-150-150">
                <div class="justify-between flex margin-bottom-70">
                    <input class="uppercase border-radius-10 teko border-none width-45 padding-15 font-size-20 bg-blanc small-100 small-margin-bottom-70" type="name" placeholder="Entrer votre Nom">
                    <input class="uppercase border-radius-10 teko border-none width-45 padding-15 font-size-20 bg-blanc small-100" type="email" placeholder="Adresse Mail">
                </div>
                <input class="uppercase border-radius-10 large-50 teko border-none width-100 padding-15 font-size-20 bg-blanc margin-bottom-70" type="text" placeholder="Le sujet de votre demande :">
                <input class="uppercase border-radius-10 large-50 teko border-none width-100 padding-15 font-size-20 padding-bottom-100 bg-blanc" type="text" placeholder="Entrer votre message ici ...">
                <div class="flex justify-center">
                    <input class="btn" type="button" value="Envoyer">
                </div>
            </form>
        </div>
        <!--Fin Vous avez une question ?-->
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="<?= asset("js/home.js") ?>" defer></script>
</body>

</html>