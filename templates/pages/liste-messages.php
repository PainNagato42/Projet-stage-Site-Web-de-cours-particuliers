<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    foreach($listeMessage as $message) { ?>
    <p>Message de : <?= $message->getTarget("expediteur")->get("pseudo") ?></p>
    <?php }
     ?>
</body>
</html>