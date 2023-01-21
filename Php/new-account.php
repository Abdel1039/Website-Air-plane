<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles-new.css">
    <title>Création du compte</title>
</head>
<body>
    <div class="form">
    <?php
    include 'BD.php';   
    global $db;?>
    <p class="titre">Créer votre compte</p>
    <form method="post">
        <input type="text" name="Npseudo" id="Npseudo" placeholder="Votre pseudo" required class="input"><br/>
        <input type="text" name="Nemail" id="Nemail" placeholder="Votre e-mail" required class="input"><br/>
        <input type="password" name="Npassword" id="Npassword" required placeholder="Crée votre mot de passe (8 characters minimum)" minlength="8" class="input"><br/>
        <input type="password" name="NCpassword" id="NCpassword" required placeholder="Confirmer votre mot de passe" class="input"><br/>
        <input type="submit" name="Inscrit" id="Inscrit" value="Inscrit" class='btn-inscrit'>
    </form>
    <a href="../index.html" class="A">Revenir à l'accueil</a>

    <?php
        if (isset($_POST['Inscrit'])){
        extract($_POST);

        if (!empty($Npseudo) && ($Nemail) && ($Npassword) && ($NCpassword)){

            if($Npassword == $NCpassword){

                $option = ['cost' => 12];

                $hashpass = password_hash($Npassword, PASSWORD_BCRYPT, $option);

                $ce = $db->prepare("SELECT email FROM id20120100_base_air_plane.users WHERE email = :email");
                $ce->execute(['email' => $Nemail]);
                $result = $ce->rowCount();

                if ($result == 0){
                    $q = $db->prepare("INSERT INTO id20120100_base_air_plane.users(pseudo,email,password) VALUES(:pseudo,:email,:password)");
                    $q->execute([
                        'pseudo' => $Npseudo,
                        'email' => $Nemail,
                        'password' => $hashpass
                    ]);

                    echo '<p class="OK">Le compte a été crée avec succès</p>';
                    ?><a class="link" href="login.php">Se connecter</a>
                    <?php
                }else{
                    echo "<p class='error'>L'email " .'"' . $Nemail . '"' . " a déja été créée</p>";
                }
            } else {
                echo '<p class="error">Les mots de passe ne sont pas les mêmes</p>';}
        } else {
            echo '<p class="error">Veuillez remplir tous les champs</p>';}

         }

    ?>
    </div>
</body>
</html>