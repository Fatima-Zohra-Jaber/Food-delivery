<?php
    // include 'config.php';

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
                header("Location: plats.php");
                exit; 
                // $_GET['idPlat']=null;
                // header("refresh:1;url=index.php");

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

   
?>
    
   
   
<div style="position: fixed; z-index: 9999; inset: 16px; pointer-events: none;"></div>
   <next-route-announcer style="position: absolute;"></next-route-announcer>
<div class="fade offcanvas-backdrop show"></div>
   <div role="dialog" aria-modal="true" class="offcanvas offcanvas-end show" tabindex="-1" id="offcanvasRight" style="visibility: visible;">
    <div class="border-bottom offcanvas-header">
        <div class="text-start">
            <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Votre Panier (<?= count($_SESSION['panier']) ?>)</h5>
            <small>Location in 382480</small>
        </div>
        <button type="button" class="btn-close" aria-label="Close"></button>
        <!-- <div class="empty-cart" <?php if (!empty($_SESSION['panier'])) echo 'style="display: none;"'; ?>>
            <img src="" alt="Empty Cart">
            <p>Aucun Historique de Commande Encore</p>
        </div> -->
    </div>
   
    
    
          
      
        <?php

        if (!empty($_SESSION['panier'])){
            ?>
            <div class="offcanvas-body">
      
      <ul class="list-group list-group-flush">
            <?php
            foreach($_SESSION['panier'] as $index => $plat)  {
                ?>
        <li class="py-3 ps-0 border-bottom list-group-item">
              <div class="align-items-center undefined row">
                  <div class="col-lg-7 col-md-6 col-6">
                      <div class="d-flex">
                          <img src="images/<?=$plat['image']?>" alt="<?=$plat['nomPlat']?>"
                          width="80" height="80" class="icon-shape icon-xxl">
                          <div class="ms-3">
                                  <h6 class="mb-0"><?=$plat['nomPlat']?></h6>
                              <div class="mt-2 small lh-1">
                                  <a class="text-decoration-none text-inherit" href="#!">
                                      <span class="me-1 align-text-bottom">
                                          <img src="images/remove.svg" alt="" class="icon-shape icon-xxl">
                                      </span>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-4">
                      <div class="input-spinner input-group input-group-sm">
                          <input class="button-minus btn btn-sm" type="button" value="-">
                          <input readonly="" class="quantity-field form-control-sm form-input quantity-field form-control-sm form-input-sm"
                           type="number" value="1" name="quantity">
                          <input class="button-plus btn btn-sm" type="button" value="+">
                      </div>
                  </div> 
                  <div class="text-center col-md-2 col-2">
                      <span class="fw-bold"><?=$plat['prix']?></span>
                  </div>                       
              </div>
          </li>
        <?php 
                // echo '<div class="cartPlat">';
                // echo "<img src='images/{$plat['image']}' alt=''>";
                // echo "<h5>".htmlspecialchars($plat['nomPlat'])."</h5>";
                // echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
                // ?>
                <!-- // <form method="POST">
                //     <button type="submit" name="action" value="increment">+</button>
                //     <span id="quantite"> <?= $plat['quantite'] ?> </span>
                //     <button type="submit" name="action" value="decrement">-</button>
                //     <button type="submit" name="action" value="supprimer">X</button>
                //     <input type="hidden" name="index" value="<?= $index ?>" >

                // </form> -->
                // <?php
                // echo '</div>'; 
            }
            ?>
            </ul>
      <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-primary btn-sm">Continue Shopping</button>
          <button type="button" class="btn btn-dark btn-sm">Proceed To Checkout</button>
      </div>
  </div>
            <?php 
        }
        ?>
</div>
        
        <div class="total" <?php if (empty($_SESSION['panier'])) echo 'style="display: none;"'; ?> >
            <span>Total:</span> <span class="total"><?= calculTotal() ?> DH</span>
        </div>
        <div>
        <a href='confirmation.php'>Confirmation</a>
        </div>
    </div>
</div>