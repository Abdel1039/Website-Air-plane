<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre profil</title>
</head>
<body>
    <?php
    if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])){
        ?>
        <p>Votre pseudo : <?= $_SESSION["pseudo"]; ?></p>
        <p>Votre email : <?=$_SESSION['email']?></p>
        <form method="post"><input type="submit" name="deconnexion" id="deconnexion" value="Déconnexion"></form>
        <?php
        if(isset($_POST['deconnexion'])){
            session_destroy();
            header("Refresh:2");
        }
        ?>
        <?php
    }else{
        echo 'Veuillez vous connectez';
        ?><a href="login.php">Connexion</a>
        <?php
    }

    ?>

</body>
</html>