<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?= include("BD.php");
    global $db;
    ?>

    <form method="post">
        <input type="text" name="Lemail" id="Lemail" placeholder="Votre email" required><br/>
        <input type="password" name="Lpassword" id="Lpassword" placeholder="Votre mots de passe" required><br/>
        <input type="submit" name="Connexion" id="Connexion" value="Connexion">
    </form>

    <?php
    if (isset($_POST["Connexion"])){
        extract($_POST);

        if (!empty($Lemail) && ($Lpassword)){

            $a = $db->prepare("SELECT * FROM id20120100_base_air_plane.users WHERE email = :email");
            $a->execute(['email' => $Lemail]);
            $result = $a->fetch();

            if($result == true){
                if (password_verify($Lpassword, $result["password"])){
                    ?><a href="../index.html">Revenir à l'accueil</a>
                    <?php

                    $_SESSION['pseudo'] = $result["pseudo"];
                    $_SESSION['email'] = $result["email"];
                    $_SESSION['id'] = $result["id"];
                    $_SESSION['date'] = $result["date"];

                }else{
                    echo "Le mot de passe n'est pas correct";
                }
            }else{
                echo "L'email ". '"' . $Lemail . '"' . " n'existe pas";
                ?><a href="new-account.php">Crée un compte</a>
                <?php
            }
        }
    }
    ?>

</body>
</html>