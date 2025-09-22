<?php
    require 'config.php';
    $idClient = $_SESSION['client']['idClient'];
    $sql = "SELECT cmd.idCmd, cmd.dateCmd, cmd.Statut, p.nomPlat, p.categoriePlat,
    p.TypeCuisine, p.prix,cmd_p.qte 
    from commande cmd JOIN commande_plat cmd_p on cmd.idCmd = cmd_p.idCmd 
    JOIN plat p on p.idPlat = cmd_p.idPlat 
    WHERE cmd.idCl= :idClient";
    $stmtCmd = $conn->prepare($sql);
    $stmtCmd->bindParam(':idClient', $idClient, PDO::PARAM_INT);
    $stmtCmd->execute();
    $commandes = $stmtCmd->fetchAll(PDO::FETCH_ASSOC);

   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>

</head>
<body class="container d-flex flex-column min-vh-100">
    <?php require 'header.php'; ?>
    <main class="flex-grow-1 mx-3">
        <h2>Historique de vos commandes</h2>
        <table class="table mx-auto mt-5 table-striped table-bordered">
            <thead>
                <tr>
                    <th>N° Commande</th>
                    <th>Date de Commande</th>
                    <th>Nom de plat</th>
                    <th>Catégorie</th>
                    <th>Type de cuissine</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Statut</th>
                    <!-- <th>Action</th> -->
                </tr>          
            </thead>
            <tbody>
                <?php
                $status_classes = [
                    'en attente' => 'bg-warning-subtle text-warning',
                    'en cours' => 'bg-primary-subtle text-primary',
                    'expédiée' => 'bg-secondary-subtle text-secondary',
                    'livrée' => 'bg-success-subtle text-success',
                    'annulée' => 'badge bg-danger-subtle text-danger'
                ];
                
                    foreach($commandes as $cmd){
                        echo "<tr>";
                            echo "<td>{$cmd['idCmd']}</td>";
                            echo "<td>{$cmd['dateCmd']}</td>";
                            echo "<td>{$cmd['nomPlat']}</td>";
                            echo "<td>{$cmd['categoriePlat']}</td>";
                            echo "<td>{$cmd['TypeCuisine']}</td>";
                            echo "<td>{$cmd['prix']}</td>";
                            echo "<td>{$cmd['qte']}</td>";
                            $statut = $cmd['Statut'];
                            $classe_css = $status_classes[$statut];
                            echo "<td><span class='badge $classe_css'>{$statut}</span></td>";                       
                        // echo "<td><a href='commandes.php?idCmd={$cmd['idCmd']}'>Annuler</a></td>";
                        echo "</tr>";
                    }

                ?>
            </tbody>
        </table>

        <!-- Cart Section -->
        <?php  include 'panier.php'; ?>
    </main>
    <?php require 'footer.php'; ?>
</body>
</html>