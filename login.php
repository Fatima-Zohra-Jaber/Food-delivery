<?php
    require 'config.php';

    if(isset($_POST['connect'])){
        if(!empty($_POST['nom']) && !empty($_POST['tel'])){
            $nom = trim(htmlspecialchars($_POST['nom']));
            $tel = trim(htmlspecialchars($_POST['tel']));
            $sqlConn = "SELECT * FROM client WHERE nomCl = :nom AND telCl = :tel";
            $stmtConn = $conn->prepare($sqlConn);
            $stmtConn->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmtConn->bindParam(':tel', $tel, PDO::PARAM_STR);
            $stmtConn->execute();
            $result = $stmtConn->fetch(PDO::FETCH_ASSOC); //renvoie false si aucune donnée n'est trouvée
            if($result){
                $_SESSION['client'] = $result;
                header("Location:index.php");
                exit;
            }else{
                echo "Nom d’utilisateur ou N° télephone non valide!";
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

    <title>Connexion</title>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100">
        
    <div class="test col-md-10 col-lg-4 p-4 p-md-5 border rounded-3 bg-body-tertiary">
        <h3 class="text-center">Connectez-vous à votre compte</h3>
        <form action="" method="POST" class="mt-5">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom d'utilisateur">
                <label for="nom">Nom d'utilisateur</label>
            </div>
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" name="tel" id="tel" placeholder="N° téléphone">
                <label for="tel">N° téléphone</label>
            </div>
         
            <button class="w-50 btn btn-lg btn-primary" type="submit" name="connect">Se connecter</button>
            <hr class="my-4">
            <div>
                Vous n’avez pas de compte?<a href="inscription.php" class="text-decoration-none"> S'inscrire</a>
            </div>
        </form>
    </div>
</body>
</html>