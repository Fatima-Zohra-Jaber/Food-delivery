<?php
    include 'config.php';
    // var_dump($plats);
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
    <h1>Liste des plats</h1>
    <section id="listCategorie">
        <h2>Type de cuisines</h2>
        <?php 
        $sql = "SELECT DISTINCT categorie FROM plat";
        $stmt = $conn->query($sql);
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($categories) { 
                foreach($categories as $categorie){
                    $nomCategorie = htmlspecialchars($categorie['categorie']);
                    echo '<div class="categorie">';
                    echo "<input type='checkbox' name='$nomCategorie ' id='$nomCategorie ' value='$nomCategorie' class='boxCategorie' onchange='filterPlats()'>";
                    echo "<label for='$nomCategorie'> $nomCategorie </label>";
                    echo '</div>';
                }
            }
        ?>
    </section>
    <section id="listPlat">
        <?php
            if ($plats) {
                foreach($plats as $plat){
                    echo '<div class="plat">';
                    echo "<img src='images/{$plat['photo']}' alt=''>";
                    echo "<h2>".htmlspecialchars($plat['nom'])."</h2>";
                    echo "<p class='categorie'>".htmlspecialchars($plat['categorie'])."</p>";
                    echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
                    echo "<a href='commande.php?idPlat={$plat['idPlat']}'>Commander</a>";
                    echo '</div>';
                }
            }else {
                echo "<p>Aucun plat disponible pour le moment.</p>";
            }
        ?>
    </section>
    
    <script src="script.js"></script>
    
</body>
</html>

