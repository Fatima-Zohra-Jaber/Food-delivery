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
    
   
   

<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-center border-bottom">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
    </div>
    <div class="order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Votre Panier (<?= count($_SESSION['panier']) ?>)</span>
            <span class="badge bg-primary rounded-pill"><?= count($_SESSION['panier']) ?></span>
        </h4>
        <?php if (empty($_SESSION['panier'])){?>
            <div class="empty-cart">
                <img src="" alt="Empty Cart">
                <p>Vous n'avez ajouté aucun produit à votre panier.</p>
            </div>      
        <?php }else{ ?>
            <ul class="list-group mb-3 list-group-flush">
            <?php
            foreach($_SESSION['panier'] as $index => $plat): ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                     <!--  li /*class="py-3 ps-0 border-bottom list-group-item"*/ -->
                    <!-- <div>
                        <h6 class="my-0">Growers cider</h6>
                        <small class="text-body-secondary">Brief description</small>
                    </div>
                    <span class="text-body-secondary">$12</span> -->
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
            <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (DH)</span>
                    <strong><?= calculTotal() ?></strong>
                </li>           
            </ul>
            <div class="w-100 btn btn-primary btn-lg" >
                <a href='confirmation.php'>Confirmation</a>
            </div>
        <?php }?>
    </div>
</div>

         
 
        
        <!-- <div class="total" <?php if (empty($_SESSION['panier'])) echo 'style="display: none;"'; ?> >
            <span>Total:</span> <span class="total"><?= calculTotal() ?> DH</span>
        </div>
        <div>
        <a href='confirmation.php'>Confirmation</a>
        </div> -->
