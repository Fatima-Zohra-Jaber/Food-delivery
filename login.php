<?php
    require 'config.php';
    session_start();
error_reporting(0);

    //session_unset();  
    //session_destroy();  // Détruit complètement la session

    if(isset($_POST['connect'])){
        if(!empty($_POST['nom']) && !empty($_POST['tel'])){
            $nom = trim(htmlspecialchars($_POST['nom']));
            $tel = trim(htmlspecialchars($_POST['tel']));
            $sqlConn = "SELECT idClient FROM client WHERE nom = :nom AND tel = :tel";
            echo"sql";
            $stmtConn = $conn->prepare($sqlConn);
            $stmtConn->bindParam(':nom', $nom);
            $stmtConn->bindParam(':tel', $tel);
            $stmtConn->execute();
            echo"execute";
            $result = $stmtConn->fetch(); //renvoie false si aucune donnée n'est trouvée
            var_dump($result);
            if($result){
                $_SESSION['idClient'] = $result['idClient'];
                var_dump($result['idClient']);
                header("Location: plats.php");
                exit; 
            }else{
                echo "Nom d’utilisateur ou N° télephone non valide!";
            }

        }else{
            echo "";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2{text-align:center;}
        form {display: flex; flex-direction: column; width: 300px; margin: auto;}
        input {margin-top: 10px; padding: 8px;}
        div { width: 300px; margin: auto; }
    </style>
</head>
<body>
    <h2>Connectez-vous à votre compte</h2>
    <form action="" method="POST">
        <input type="text" placeholder="Nom d'utilisateur" name="nom" />
        <input type="tel" placeholder="N° téléphone" name="tel" />
        <input type="submit"  name="connect" value="Se connecter" />
    </form>
    <div>
        Vous n’avez pas de compte?<a href="inscription.php"> S'inscrire</a>
    </div>
</body>
</html>