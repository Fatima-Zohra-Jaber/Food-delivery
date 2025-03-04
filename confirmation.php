<?php
    require 'config.php';
    if(!isset($_SESSION['client'])){
        header("Location:login.php");
        exit;
    }else{
        $idClient = $_SESSION['client']['idClient'];
        $plats = $_SESSION['panier'];
    }
    if(isset($_GET['idClient'])){
        // Récupérer le dernier idCmd 
        $sqlIdCmd = "SELECT idCmd FROM commande ORDER BY dateCmd DESC LIMIT 1";
        $stmIdCmd = $conn->query($sqlIdCmd);
        $id = $stmIdCmd->fetch(PDO::FETCH_ASSOC);
        // Calculer le prochain idCmd
        $nextId = $id ? substr($id['idCmd'], 1) + 1 : 1; // Si pas d'idCmd existant, commencer à 1
        $idCmd = "C" . str_pad($nextId, 3, '0', STR_PAD_LEFT); // Ajouter "C" et formater avec 3 chiffres
        echo $idCmd;
        
        // Insérer la commande dans la table commande
        $sqlCmd="INSERT INTO commande(idCmd, idCl) VALUES(:idCmd, :idCl)";
        $stmtCmd = $conn->prepare($sqlCmd);
        $stmtCmd-> bindParam(':idCmd', $idCmd, PDO::PARAM_STR);
        $stmtCmd-> bindParam(':idCl', $idClient, PDO::PARAM_INT);
        $stmtCmd->execute();
        // Insérer les plats associés à la commande
        foreach ($plats as $plat){
            $sqlCmdPlat = "INSERT INTO commande_plat VALUES(:idPlat, :idCmd, :qte)";
            $sqlCmdPlat = $conn->prepare($sqlCmdPlat);
            $sqlCmdPlat->bindParam(':idPlat', $plat['idPlat'], PDO::PARAM_INT);
            $sqlCmdPlat->bindParam(':idCmd', $idCmd, PDO::PARAM_STR);
            $sqlCmdPlat->bindParam(':qte', $plat['quantite'], PDO::PARAM_INT);
            $sqlCmdPlat->execute();
            
        }
        echo "<script>alert(Merci. Votre commande a été passée !)</script>";
        unset($_SESSION['panier']);
        header('Location:commandes.php');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <?php
        include 'header.php';
    ?>

    <section class="container h-100 py-2">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="h5">Image</th>
                    <th scope="col">Nom de plat</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix</th>
                </tr>
            </thead>
            <tbody>
             
        <?php
            if (!empty($_SESSION['panier'])):
                foreach($_SESSION['panier'] as $index => $plat): ?>
                <tr>
                    <td>
                        <img src="images/<?=$plat['image']?>" class="img-fluid rounded-3" style="width: 110px;">
                    </td>
                    <td class="align-middle">
                    <p class="mb-0" style="font-weight: 500;"> <?=htmlspecialchars($plat['nomPlat'])?> </p>
                    </td>
                    <td class="align-middle">
                    <p class="mb-0" style="font-weight: 500;"> <?=htmlspecialchars($plat['quantite'])?></p>
                    </td>
                    <td class="align-middle">
                    <p class="mb-0" style="font-weight: 500;"> <?=htmlspecialchars($plat['prix'])?>Dh</p>
                    </td>
                </tr> 
                <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
            <tfoot>
                <th colspan="3">Total</th> 
                <th><?= calculTotal() ?> DH</th>        
            </tfoot>
            
        </table>    
        <div class="d-flex justify-content-end col-12">
            <a href="confirmation.php?idClient=<?= $idClient ?>" class="btn btn-danger">Commander</a>
        </div>            
     
    </section>
</body>
</html>