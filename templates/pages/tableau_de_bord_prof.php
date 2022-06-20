<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>Votre tableau de bord</h2>
    <div style="border: 1px solid #000">
        <p>Vous avez <?= $P->getTarget("utilisateur")->get("points") ?> points</p><a href="#">Acheter des points</a>
    </div>
    <div style="border: 1px solid #000">
        <p>Vous avez <?= $C->compteurByProf($P->get("id"))  ?> cours actif(s)</p>
    </div>
    <div style="border: 1px solid #000">
        <p>Vous avez accepté <?= $P->totalEleves($P->get("id")) ?> élève(s)</p>
    </div>
    <div style="border: 1px solid #000">
        <p>Vous avez <?php
                        if (empty($listeMessage)) {
                            echo "0";
                        } else {
                            foreach ($listeMessage as $accept) {
                                $nombreAccept = 0;
                                if ($accept->get("accepte") == 0) {
                                    $nombreAccept += 1;
                                }
                                echo $nombreAccept;
                            }
                        } ?> élève(s) en attente</p>
        <a href="<?= $ROOT ?>/prive/messages/">Voir mes messages</a>
    </div>

</body>

</html>