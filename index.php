<?php
    include 'config.php';
    // var_dump($plats);
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);

    function getPlats($plat) {
        echo '<div class="plat">';
        echo "<img src='images/{$plat['image']}' alt=''>";
        echo "<h2>".htmlspecialchars($plat['nomPlat'])."</h2>";
        echo "<p class='categorie'>".htmlspecialchars($plat['categoriePlat'])."</p>";
        echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
        echo "<a href='commande.php?idPlat={$plat['idPlat']}'>Commander</a>";
        echo '</div>';                  
    }

    $platsRecherch = [];
    if(isset($_POST['submitRecherch'])){ 
        $typeRecherch = $_POST['typeRecherch'];
        $inputRecherch= $_POST['inputRecherch'];
        var_dump($inputRecherch);
        $stmt = $conn->prepare("SELECT * FROM plat WHERE $typeRecherch LIKE :searchValue");
        $searchValue = '%' . $inputRecherch . '%'; 
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        echo "SELECT * FROM plat WHERE $typeRecherch LIKE '$searchValue'";
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
    <link rel="stylesheet" href="style.css">
</head>
<body> 

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
            <option value="Marocaine">plat principal</option>
            <option value="Italienne">dessert</option>
            <option value="Chinoise">entrée</option>
        </select>
        <!-- <input type="text" id="recherche" placeholder="Rechercher" name="inputRecherch"> -->
        <button type="submit" name="submitRecherch" >Rechercher</button>
    </form>
   
    
    <section id="listPlat">
        <?php
            // if(!empty($platsRecherch)){
            //     echo "<h1>Résultats de recherche :</h1>";
            //     // echo "<h2>Plats $platsRecherch[]</h2>";
            //     echo "<div class='platCuisine'>";
            //     foreach($platsRecherch as $plat){                   
            //         getPlats($plat);                
            //     }
            //     echo "</div>";
            // }else{
                echo "<h1>Liste des plats</h1>";
                $sql = "SELECT DISTINCT TypeCuisine FROM plat";
                $stmt = $conn->query($sql);
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmtPlats = $conn->query("SELECT * FROM plat");  //Utilisé pour des requêtes simples sans paramètres, est plus direct et rapide, mais moins flexible.
                $plats = $stmtPlats->fetchAll(PDO::FETCH_ASSOC);

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
            // }
            // food delivery website github php mysql
            
        ?>
    </section>
    
    <script src="script.js"></script>
    
</body>
</html>

