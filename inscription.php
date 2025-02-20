<?php
    require 'config.php';

    function getIdClient(){
        global $conn;
        $sqlId = "SELECT max(idClient) as maxId from client";
        $stmtId = $conn->query($sqlId);
        $maxId = $stmtId->fetch(PDO::FETCH_ASSOC);
        if(isset($maxId)){
            $id = $maxId + 1;
        }else{
            $id = 1;
        }
        return $id;
    }
    function checkTel(){
        global $conn, $tel;
        $sqlCheckTel = "SELECT idClient FROM client WHERE tel = :tel";
        $stmtCheck = $conn->prepare($sqlCheckTel);
        $stmtCheck->bindParam(':tel', $tel);
        $stmtCheck->execute();
        $resultCheck= $stmtCheck->fetch(PDO::FETCH_ASSOC);
        if(isset($resultCheck)){
            return true;
        }else{
            return false;
        }
    }
    $erreurs = [];
    if(isset($_POST['inscrire'])){
        if(!empty($_POST['nom'])){
            $nom = trim(htmlspecialchars($_POST['nom']));
        }else{
            $erreurs['nom'] = "Veuillez entrer le nom";
        }
        if(!empty($_POST['prenom'])){
            $prenom = trim(htmlspecialchars($_POST['prenom']));
        }else{
            $erreurs['prenom'] = "Veuillez entrer le prénom";
        }
        if(!empty($_POST['tel'])){
            $tel = trim(htmlspecialchars($_POST['tel']));
        }else{
            $erreurs['tel'] = "Veuillez entrer le n° de téléphone";
        }
        if(empty($erreurs)){
             // Vérifier si le numéro de téléphone existe déjà
            
             
             if(checkTel()){
                 $erreurs['tel'] = "Ce numéro de téléphone est déjà utilisé!";
             } else {
                $sqlInsetClient = "INSERT into client values(:idCl,:nom,:prenom,:tel)";
                $stmtInsertClient = $conn->prepare($sqlInsetClient);
                $idCl = getIdClient();
                $stmtInsertClient->bindParam(':idCl', $idCl);
                $stmtInsertClient->bindParam(':nom', $nom);
                $stmtInsertClient->bindParam(':prenom', $prenom);
                $stmtInsertClient->bindParam(':tel', $tel);
                $stmtInsertClient->execute();

                header("Location: index.php");
                exit();
             }
        }
    }  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        h2{text-align:center;}
        form {display: flex; flex-direction: column; width: 300px; margin: auto;}
        input {margin-top: 10px; padding: 8px;}
        div { width: 300px; margin: auto; }
        .erreur { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <h2>Inscrivez-vous pour commander les plats</h2>
    <form action="" method="POST">
        <input type="text" placeholder="Nom" name="nom" />
        <span class="erreur"><?= $erreurs['nom'] ?? '' ?></span>
        <input type="text" placeholder="¨Prénom" name="prenom" />
        <span class="erreur"><?= $erreurs['prenom'] ?? '' ?></span>
        <input type="tel" placeholder="N° téléphone" name="tel" />
        <span class="erreur"><?= $erreurs['tel'] ?? '' ?></span>
        <input type="submit"  name="inscrire" value="S'inscrire" />
    </form>
    <div>Vous avez un compte ?<a href="login.php"> Connectez-vous</a></div>
</body>
</html>