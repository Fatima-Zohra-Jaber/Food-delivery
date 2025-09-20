<?php
    require 'config.php';
  
    // Pagination
    $platsParPage = 6;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $platsParPage;

    // Récupérer tous les plats pour la pagination
    $sqlCount = "SELECT COUNT(*) as total FROM plat";
    $stmtCount = $conn->query($sqlCount);
    $totalPlats = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($totalPlats / $platsParPage);

    $sqlPlats = "SELECT * FROM plat LIMIT :limit OFFSET :offset";
    $stmtPlats = $conn->prepare($sqlPlats);
    $stmtPlats->bindValue(':limit', $platsParPage, PDO::PARAM_INT);
    $stmtPlats->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmtPlats->execute();
    $plats = $stmtPlats->fetchAll(PDO::FETCH_ASSOC);

    function getPlats($plat) {
        echo "<div class='col-md-6 col-lg-4 mb-4' id='{$plat['idPlat']}'>";
            echo "<div class='card plat h-100 shadow rounded border-0' style='background: #fff;'>";
            echo "<img src='images/{$plat['image']}' class='card-img-top rounded-top' alt='' style='height:220px;object-fit:cover;'>";
            echo "<div class='card-body d-flex flex-column'>";
            echo "<h5 class='card-title fw-bold'>{$plat['nomPlat']}</h5>";
            echo "<p class='card-text categorie mb-1'><span class='badge bg-light text-dark'>{$plat['categoriePlat']}</span></p>";
            echo "<p class='mb-2'><span class='fw-bold text-danger'>{$plat['prix']} DH</span></p>";
            echo "<a href='plats.php?idPlat={$plat['idPlat']}' class='btn btn-danger w-100 mt-auto'>Commander</a>";
            echo "</div>";
            echo "</div>";
        echo "</div>";

    }

    $platsRecherch = [];
    if(isset($_POST['TypeCuisine']) || isset($_POST['categoriePlat'])){
        $TypeCuisine = $_POST['TypeCuisine'];
        $categoriePlat= $_POST['categoriePlat'];
        $condition='';
        if(!empty($TypeCuisine ) and !empty($categoriePlat)){
            $condition = " TypeCuisine = :TypeCuisine and categoriePlat = :categoriePlat";
        }else{
            $condition = "TypeCuisine = :TypeCuisine or categoriePlat = :categoriePlat";
        }
        $sql = "SELECT * FROM plat WHERE $condition";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':TypeCuisine', $TypeCuisine, PDO::PARAM_STR);
        $stmt->bindParam(':categoriePlat', $categoriePlat, PDO::PARAM_STR);
        $stmt->execute();
        $platsRecherch = $stmt->fetchAll(PDO::FETCH_DEFAULT);        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Plats</title>
    
    <?php
    include 'header.php';
    ?>

    <form id="recherche" method="post" class="container mx-auto row g-3 justify-content-center align-items-center my-4 pb-3 shadow rounded bg-white">
        <div class="col-md-4">
            <select name="TypeCuisine" class="form-select">
                <option value="">Type de cuisine</option>
                <option value="Marocaine">Marocaine</option>
                <option value="Italienne">Italienne</option>
                <option value="Chinoise">Chinoise</option>
                <option value="Espagnole">Espagnole</option>
                <option value="Francaise">Francaise</option>
            </select>
        </div>
        <div class="col-md-4">
            <select name="categoriePlat" class="form-select">
                <option value="">Catégorie de plat</option>
                <option value="plat principal">Plat principal</option>
                <option value="dessert">Dessert</option>
                <option value="entrée">Entrée</option>
            </select>
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" name="submitRecherch" class="btn btn-danger">Rechercher</button>
        </div>
    </form>
    <main class="container">
       <!-- Plats Section -->
       <section id="listPlat" class="container text-center py-2">
        <?php
            if(!empty($platsRecherch)){
                echo "<h1 class='fw-bold text-danger mb-4 display-5'>Résultat de votre recherche :</h1>";
                echo "<div class='platCuisine row g-4'>";
                // echo "<h2>Plats $platsRecherch[]</h2>";
                foreach($platsRecherch as $plat){                   
                    getPlats($plat);                
                }
                echo "</div>";
            }else{
                echo "<h1 class='fw-bold text-danger mb-4 display-5'>Liste des plats</h1>";
                $sql = "SELECT DISTINCT TypeCuisine FROM plat";
                $stmt = $conn->query($sql);
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($categories)) {
                    foreach($categories as $categorie){
                        $nomCategorie = htmlspecialchars($categorie['TypeCuisine']);
                        // Vérifier s'il y a des plats de cette catégorie sur la page courante
                        $platsCategorie = array_filter($plats, function($plat) use ($nomCategorie) {
                            return $plat['TypeCuisine'] == $nomCategorie;
                        });
                        if(count($platsCategorie) > 0){
                            echo "<h2 class='fw-semibold text-primary my-3 h3'>Plats $nomCategorie</h2>";
                            echo "<div class='platCuisine row g-4'>";
                            foreach($platsCategorie as $plat){
                                getPlats($plat);
                            }
                            echo "</div>";
                        }
                    }
                }else {
                    echo "<p class='alert alert-warning' role='alert'>Aucun plat disponible pour le moment.</p>";
                }
                // Pagination
                if($totalPages > 1){
                    echo '<nav aria-label="Page navigation" class="mt-4">';
                    echo '<ul class="pagination justify-content-center">';
                    for($i = 1; $i <= $totalPages; $i++){
                        $active = ($i == $page) ? 'active' : '';
                        echo "<li class='page-item $active'><a class='page-link' href='plats.php?page=$i'>$i</a></li>";
                    }
                    echo '</ul>';
                    echo '</nav>';
                }
            }
        ?>
        </section>
            <!-- Cart Section -->
           <?php  include 'panier.php'; ?>
    </main>
    
  
 <?php require 'footer.php'; ?>

    
</body>
</html>

