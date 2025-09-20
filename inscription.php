<?php
    require 'config.php';

    function getIdClient(){
        global $conn;
        $sqlId = "SELECT max(idClient) as maxId from client";
        $stmtId = $conn->query($sqlId);
        $maxId = $stmtId->fetch(PDO::FETCH_ASSOC);
        if(empty($maxId['maxId'] )){
            $id = 1;
        }else{
            $id = $maxId['maxId'] + 1;
        }
        return $id;
    }
    function checkTel(){
        global $conn, $tel;
        $sqlCheckTel = "SELECT idClient FROM client WHERE telCl = :tel";
        $stmtCheck = $conn->prepare($sqlCheckTel);
        $stmtCheck->bindParam(':tel', $tel);
        $stmtCheck->execute();
        $result= $stmtCheck->fetch(PDO::FETCH_ASSOC);
        return $result;
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
                $stmtInsertClient->bindParam(':idCl', $idCl, PDO::PARAM_INT);
                $stmtInsertClient->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmtInsertClient->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmtInsertClient->bindParam(':tel', $tel, PDO::PARAM_STR);
                $stmtInsertClient->execute();

                header("Location: login.php");
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Inscription</title>
    <style>
        /* h2{text-align:center;}
        form {display: flex; flex-direction: column; width: 300px; margin: auto;}
        input {margin-top: 10px; padding: 8px;}
        div { width: 300px; margin: auto; }
        .erreur { color: red; font-size: 14px; } */
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">

    <div class="test col-md-10 col-lg-4 p-4 p-md-5 border rounded-3 bg-body-tertiary">
        <h3 class="text-center">Inscrivez-vous pour commander les plats</h3>
        <form action="" method="POST" class="mt-5">

            <div class="form-floating mb-3">
                <input type="text" placeholder="Nom" name="nom" id="nom" class="form-control"/>
                <label for="nom">Nom</label>
                <span class="erreur"><?= $erreurs['nom'] ?? '' ?></span>
            </div>

            <div class="form-floating mb-3">
                <input type="text" placeholder="Prénom" name="prenom" id="prenom" class="form-control"/>
                <label for="prenom">Prénom</label>
                <span class="erreur"><?= $erreurs['prenom'] ?? '' ?></span>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" placeholder="N° téléphone" name="tel" id="tel" class="form-control"/>
                <label for="tel">N° téléphone</label>
                <span class="erreur"><?= $erreurs['tel'] ?? '' ?></span>
            </div>

            <input type="submit"  name="inscrire" value="S'inscrire" class="w-50 btn btn-lg btn-primary"/>

        </form>
        <hr class="my-4">
        <div>Vous avez un compte ?<a href="login.php" class="text-decoration-none"> Connectez-vous</a></div>
       
    </div>
</body>
</html>