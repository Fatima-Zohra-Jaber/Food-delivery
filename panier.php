<?php
    session_start();
    //session_unset();  
    //session_destroy();  // Détruit complètement la session

    if (!isset($_SESSION['panier'])) {
        $_SESSION['panier'] = [];
    }

          // $panierPlats = [];
        // Ajout d'un plat au panier
        if (isset($_GET['idPlat'])) {
            $idPlat = (int) $_GET['idPlat'];
            $sql = "SELECT * FROM plat WHERE idPlat = $idPlat";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $panierplat = $stmt->fetch(PDO::FETCH_ASSOC); // pour récupérer directement la première ligne du résultat.
            // $plat = $stmt->fetchAll(PDO::FETCH_ASSOC); pour récupérer toutes les lignes
            // $plat = $plat[0];
            // array_push($panierPlats,$panierplat);

            if ($panierplat) { 
                $panierplat['quantite'] = 1;
                $found = false;
                foreach ($_SESSION['panier'] as &$item) {
                    if ($item['idPlat'] == $panierplat['idPlat']) {
                        $item['quantite'] += 1 ; 
                        $found = true;
                    }
                    unset($item);
                }
            if (!$found) {
                $_SESSION['panier'][] = $panierplat; 
            }
            }
        }
    
        // if (isset($_POST['id']) && isset($_POST['action'])) {
        //     $id = (int) $_POST['id'];
        //     foreach ($_SESSION['panier'] as $index => $plat) {
        //         if ($plat['idPlat'] == $id) {
        //             if ($_POST['action'] == 'increment') {
        //                 $plat['quantite']++;
        //             } elseif ($_POST['action'] == 'decrement' && $plat['quantite'] > 1) {
        //                 $plat['quantite']--;
        //             }  elseif ($_POST['action'] == 'supprimer') {
        //                 unset($_SESSION['panier'][$index]); 
        //                 $_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexation
                        
        //             }
        //         }  
        //     }      
        // }   
    if (isset($_POST['index']) && isset($_POST['action'])) {
        $index = (int) $_POST['index'];
        // var_dump($_SESSION['panier']);
        // echo "</br> index: $index </br>";
        // var_dump($_SESSION['panier'][$index]);
        if ($_POST['action'] == 'increment') {
            $_SESSION['panier'][$index]['quantite']++;
        } elseif ($_POST['action'] == 'decrement' && $_SESSION['panier'][$index]['quantite'] > 1) {
            $_SESSION['panier'][$index]['quantite']--;
        }  elseif ($_POST['action'] == 'supprimer') {
            array_splice($_SESSION['panier'], $index, 1);//le tableau est réindexé automatiquement
            //unset($_SESSION['panier'][$index]); // La fonction ne réorganise pas les index
            //$_SESSION['panier'] = array_values($_SESSION['panier']); // Réindexation
            
        }
    }

    function calculTotal(){
        $total = 0;
        foreach($_SESSION['panier'] as $plat){
            $total += $plat['prix'] * $plat['quantite'];
        }
        return $total;
    }
?>
    
<h2 id="count">Votre Panier (<?= count($_SESSION['panier']) ?>)</h2>
    <div class="empty-cart" <?php if (!empty($_SESSION['panier'])) echo 'style="display: none;"'; ?>>
        <img src="" alt="Empty Cart">
        <p>Aucun Historique de Commande Encore</p>
    </div>
    
    <div class="cartPlats">
        <?php

        if (!empty($_SESSION['panier'])){
            // var_dump(($_SESSION['panier']));
            foreach($_SESSION['panier'] as $index => $plat)  {
                echo '<div class="cartPlat">';
                echo "<img src='images/{$plat['image']}' alt=''>";
                echo "<h5>".htmlspecialchars($plat['nomPlat'])."</h5>";
                echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
        ?>
                <form method="POST">
                    <button type="submit" name="action" value="increment">+</button>
                    <span id="quantite"> <?= $plat['quantite'] ?> </span>
                    <button type="submit" name="action" value="decrement">-</button>
                    <button type="submit" name="action" value="supprimer">X</button>
                    <input type="hidden" name="index" value="<?= $index ?>" >

                </form>
                <?php
                echo '</div>'; 
            }
        }
        ?>
        
        <div class="total" <?php if (empty($_SESSION['panier'])) echo 'style="display: none;"'; ?> >
            <span>Total:</span> <span class="total"><?= calculTotal() ?> DH</span>
        </div>
        </div>
    </div>
</div>