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

    <div> 
        <?php if (empty($_SESSION['panier'])){?>
            <div class="p-5 d-flex flex-column align-items-center">
                <img src="images/panierVide.png" alt="Empty Cart" class="w-50 my-4">
                <p>Votre panier est vide.</p>
            </div>      
        <?php }else{ ?>
            <ul class="list-group mb-3 px-3 list-group-flush" >
            <?php
            foreach($_SESSION['panier'] as $index => $plat): ?>
                
                <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                    <div class="d-flex align-items-center me-2">
                        <img src="images/<?= $plat['image'] ?>" alt="<?= $plat['nomPlat'] ?>" width="60" height="60" class="rounded ms-0">
                        <div class="ms-3">
                            <h6 class="mb-0"><?= $plat['nomPlat'] ?></h6>
                            <div class="fw-bold text-end" style="width: 70px;">
                                <?= number_format($plat['prix'], 2) ?>Dh
                            </div>
                        </div>
                    </div>

                    <form method="POST" class="d-flex align-items-center">
                        <div class="input-group input-group-sm mx-2">
                            <button name="action" value="decrement" class="btn btn-outline-secondary btn-sm p-1">-</button>
                            <span class="text-center px-2 form-control border-0 bg-white"><?= $plat['quantite'] ?></span>
                            <button name="action" value="increment" class="btn btn-outline-secondary btn-sm p-1">+</button>
                        </div>
                        <input type="hidden" name="index" value="<?= $index ?>" >
                        <button type="submit" name="action" value="supprimer" class="btn btn-link text-danger btn-sm p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                        </button>
                    </form> 
                </li>

            <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (DH)</span>
                    <strong><?=number_format(calculTotal(), 2)?></strong>
                </li>           
            </ul>
            <div class="btn btn-danger btn-lg d-grid gap-2 col-6 mx-auto mt-4" >
                <a href='confirmation.php' class="text-light text-decoration-none">Confirmation</a>
            </div>
        <?php }?>
    </div>
            </section>

