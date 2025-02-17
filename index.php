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
    <section >
        <?php
            if ($plats) {
                foreach($plats as $plat){
                    echo '<div class="plat">';
                    echo "<h2>".htmlspecialchars($plat['nom'])."</h2>";
                    echo "<p>".htmlspecialchars($plat['categorie'])."</p>";
                    echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
                    echo "<a href='commande.php?idPlat={$plat['idPlat']}'>Commander</a>";
                    echo '</div>';
                }
            }else {
                echo "<p>Aucun plat disponible pour le moment.</p>";
            }
        ?>
    </section>
    
    
</body>
</html>

