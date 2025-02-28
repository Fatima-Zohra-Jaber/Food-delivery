<?php
    // include 'config.php';

    if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
    }
         
        if (isset($_GET['idPlat'])) {
            $idPlat = (int) $_GET['idPlat'];
            $sql = "SELECT * FROM plat WHERE idPlat = $idPlat";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $panierplat = $stmt->fetch(PDO::FETCH_ASSOC); 
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
<section class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header d-flex justify-content-center align-items-center border-bottom">
        <h4>
            <span class="text-danger">Votre Panier (<?= count($_SESSION['panier']) ?>)</span>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <!-- <div class="offcanvas-body"></div> -->
    <div> <!-- class="order-md-last" -->
        <?php if (empty($_SESSION['panier'])){?>
            <div class="empty-cart">
                <img src="images/panierVide.png" alt="Empty Cart" class="w-50 mx-auto my-4">
                <p class="mx-autp">Vous n'avez ajouté aucun produit à votre panier.</p>
            </div>      
        <?php }else{ ?>
            <ul class="list-group mb-3 px-3 list-group-flush" >
            <?php
            foreach($_SESSION['panier'] as $index => $plat): ?>
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <!-- <div class="align-items-center undefined row"> -->
                        <div class="col-lg-7 col-md-6 col-6"> 
                            <div class="d-flex">
                                <img src="images/<?=$plat['image']?>" alt="<?=$plat['nomPlat']?>"
                                width="60" height="60" class="icon-shape icon-xxl">
                                <div class="ms-3">
                                  <h6 class="mb-0"><?=$plat['nomPlat']?></h6>             
                           </div>
                        <!--  </div> -->
                    </div>

                  <form method="POST">
                    <div class="input-group input-group-sm">
                        <button type="submit" name="action" value="increment" class="px-2 border-300 btn btn-outline-secondary btn-sm" >+</button>
                        <span id="quantite" class="text-center px-2 input-spin-none form-control" style="width: 50px;"> <?= $plat['quantite'] ?> </span>
                        <button type="submit" name="action" value="decrement" class="px-2 border-300 btn btn-outline-secondary btn-sm">-</button>
                    </div>   
                    <input type="hidden" name="index" value="<?= $index ?>" >
                    <button type="submit" name="action" value="supprimer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-danger">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>                          
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                        </svg>
                    </button>
                  </form> 
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
            <div class="btn btn-danger btn-lg mx-auto" >
                <a href='confirmation.php' class="text-light text-decoration-none">Confirmation</a>
            </div>
        <?php }?>
    </div>
            </section>

         
 
        
        <!-- <div class="total" <?php if (empty($_SESSION['panier'])) echo 'style="display: none;"'; ?> >
            <span>Total:</span> <span class="total"><?= calculTotal() ?> DH</span>
        </div>
        <div>
        <a href='confirmation.php'>Confirmation</a>
        </div> -->
