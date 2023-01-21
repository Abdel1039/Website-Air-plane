<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles-profil.css">
    <title>Votre profil</title>
</head>
<body>
    <div class="from">
    <?php
    if(isset($_SESSION['pseudo']) && isset($_SESSION['email'])){
        ?>
        <p class="titre">Votre profil</p>
        <p class="info">Votre pseudo : <?= $_SESSION["pseudo"]; ?></p>
        <p class="info">Votre email : <?=$_SESSION['email']?></p>
        <form method="post"><input type="submit" name="deconnexion" id="deconnexion" value="Déconnexion" class="deco"></form>
        <?php
        if(isset($_POST['deconnexion'])){
            session_destroy();
            header("Refresh:2");
        }
        ?>
        <?php
    }else{
        echo "<p class='echo'>Veuillez vous connectez</p>";
        ?><a class="link" href="login.php">Connexion</a>
        <?php
    }

    ?>
    </div>

</body>
</html>