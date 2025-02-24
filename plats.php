<?php
    require 'config.php';
  
     
    function getPlats($plat) {
        echo "<div class='col-md-6 col-lg-4'>";
            echo '<div class="card plat h-100">';
                echo "<img src='images/{$plat['image']}' class='card-img-top' alt=''>";
                echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>".htmlspecialchars($plat['nomPlat'])."</h5>";
                    echo "<p class='card-text categorie' >".htmlspecialchars($plat['categoriePlat'])."</p>";
                    echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
                    echo "<a href='plats.php?idPlat={$plat['idPlat']}' class='btn btn-danger'>Commander</a>";
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

     <form id="recherche"  method="post">
            <select name="TypeCuisine" id="">
                <option value="">Type de cuisine</option>
                <option value="Marocaine">Marocaine</option>
                <option value="Italienne">Italienne</option>
                <option value="Chinoise">Chinoise</option>
                <option value="Espagnole">Espagnole</option>
                <option value="Francaise">Francaise</option>
            </select>
            <select name="categoriePlat" id="">
                <option value="">Categorie de plat</option>
                <option value="plat principal">plat principal</option>
                <option value="dessert">dessert</option>
                <option value="entrée">entrée</option>
            </select>
            <!-- <input type="text" id="recherche" placeholder="Rechercher" name="inputRecherch"> -->
            <button type="submit" name="submitRecherch" >Rechercher</button>
        </form>
    <main>
       <!-- Plats Section -->
       <section id="listPlat" class="container text-center py-5">
        <?php
            if(!empty($platsRecherch)){
                echo "<h1>Résultats de recherche :</h1>";
                echo "<div class='platCuisine row g-4'>";
                // echo "<h2>Plats $platsRecherch[]</h2>";
                foreach($platsRecherch as $plat){                   
                    getPlats($plat);                
                }
                echo "</div>";
            }else{
                echo "<h1>Liste des plats</h1>";
                $sql = "SELECT DISTINCT TypeCuisine FROM plat";
                $stmt = $conn->query($sql);
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($categories)) {
                    foreach($categories as $categorie){
                        $nomCategorie = htmlspecialchars($categorie['TypeCuisine']);
                        echo "<h2>Plats $nomCategorie</h2>";
                        echo "<div class='platCuisine row g-4'>";

                            foreach($plats as $plat){
                                if ($plat['TypeCuisine'] == $nomCategorie) {
                                    getPlats($plat);
                                }
                            }
                        echo "</div>";
                    }
                }else {
                    echo "<p>Aucun plat disponible pour le moment.</p>";
                }
            }
        ?>
        </section>
            <!-- Cart Section -->
        <section class="panier">
           <?php  include 'panier.php'; ?>
        </section>
    </main>
    
   <footer></footer>
   
    <!-- <script src="script.js"></script> -->
    
</body>
</html>

