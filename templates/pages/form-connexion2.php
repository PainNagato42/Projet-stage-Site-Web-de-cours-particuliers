<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Se connecter</h1>
    <form method="POST" action="<?= $ROOT ?>/public/connecte/">
        <label for="email">Email :</label><br>
        <input type="email" name="email" id="email" /><br><br>
        <label for="password">Mot de passe :</label><br>
        <input type="password" name="password" id="password" /><br><br>
        <p><?= isset($erreur) ? $erreur : "" ?></p>
        <input type="submit" value="se connecter" />
    </form>
</body>
</html>