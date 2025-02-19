<?php
    include 'config.php';
    // var_dump($plats);
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    function getPlats($plat) {
        echo '<div class="plat">';
        echo "<img src='images/{$plat['image']}' alt=''>";
        echo "<h4>".htmlspecialchars($plat['nomPlat'])."</h4>";
        echo "<p class='categorie'>".htmlspecialchars($plat['categoriePlat'])."</p>";
        echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
        echo "<a href='index.php?idPlat={$plat['idPlat']}'>Commander</a>";
        echo '</div>';                  
    }

    $platsRecherch = [];
    if(isset($_POST['TypeCuisine']) || ($_POST['categoriePlat']) ){
        $TypeCuisine = $_POST['TypeCuisine'];
        $categoriePlat= $_POST['categoriePlat'];
        $condition='';
        if(!empty($TypeCuisine ) and !empty($categoriePlat)){
            $condition = " TypeCuisine = '$TypeCuisine' and categoriePlat = '$categoriePlat'";
        }else{
            $condition = "TypeCuisine = '$TypeCuisine' or categoriePlat = '$categoriePlat'";
        }
        $sql = "SELECT * FROM plat WHERE $condition";
        $stmt = $conn->prepare($sql);
        // echo $sql;
        $stmt->execute();
        $platsRecherch = $stmt->fetchAll(PDO::FETCH_DEFAULT);        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>
    <link rel="stylesheet" href="style.css?v=9">
</head>
<body> 
    <header>
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
    </header>
    
    <main>
       <!-- Plats Section -->
       <section id="listPlat">
        <?php
            if(!empty($platsRecherch)){
                echo "<h1>Résultats de recherche :</h1>";
                // echo "<h2>Plats $platsRecherch[]</h2>";
                echo "<div class='platCuisine'>";
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
                        echo "<div class='platCuisine'>";
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
    
   
       
    <script src="script.js"></script>
    
</body>
</html>

