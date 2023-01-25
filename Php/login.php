<?php session_start()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-connexion.css">
    <title>Connexion</title>
</head>
<body>
    <?php include("BD.php");
    global $db;
    ?>

    <div class="form">
        <p class="titre">VEUILLEZ SAISIR VOTRE ADRESSE EMAIL ET VOTRE MOT DE PASSE</p>
    <form method="post">
        <input type="text" name="Lemail" id="Lemail" placeholder="Votre email" required class="input"><br/>
        <input type="password" name="Lpassword" id="Lpassword" placeholder="Votre mots de passe" required class="input"><br/>
        <input type="submit" name="Connexion" id="Connexion" value="Connexion" class="btn-connect">
    </form>
    <a href="../index.html" class="A">Revenir à l'accueil</a>
    <?php
    if (isset($_POST["Connexion"])){
        extract($_POST);

        if (!empty($Lemail) && ($Lpassword)){

            $a = $db->prepare("SELECT * FROM id20120100_base_air_plane.users WHERE email = :email");
            $a->execute(['email' => $Lemail]);
            $result = $a->fetch();

            if($result == true){
                if (password_verify($Lpassword, $result["password"])){
                    echo "<p class='succe'>Connexion réussie</p>";
                    echo "<a class='link' href='profil.php'>Allez sur votre profil</a>";
                    echo "<a class='link' href='../index.html'>Revenir à l'accueil</a>";

                    $_SESSION['pseudo'] = $result["pseudo"];
                    $_SESSION['email'] = $result["email"];
                    $_SESSION['id'] = $result["id"];
                    $_SESSION['date'] = $result["date"];

                }else{
                    echo "<p class='echo'>Le mot de passe n'est pas correct</p>";
                }
            }else{
                    echo"<p class='echo'>L'email ". '"' . $Lemail . '"' . " n'existe pas</p> "
                ?><a class="echo lien" href="new-account.php">Crée un compte</a>
                <?php
            }
        }
    }
    ?>
    </div>

</body>
</html>