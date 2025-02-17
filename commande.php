<?php
    include 'config.php';

    if (isset($_GET['idPlat'])) {
        $idPlat = $_GET['idPlat'];
        $sql = "SELECT * FROM plat WHERE idPlat = $idPlat";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $plat = $stmt->fetch(PDO::FETCH_ASSOC); // pour récupérer directement la première ligne du résultat.
        // $plat = $stmt->fetchAll(PDO::FETCH_ASSOC); pour récupérer toutes les lignes
        // $plat = $plat[0];
    }

    $quantite = 1;
    if (isset($_POST['quantite'])) {
        $quantite = (int) $_POST['quantite'];  
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande</title>
</head>
<body>
    <?php
        if (!empty($plat)) :
            echo '<div>';
            echo "<h2>".htmlspecialchars($plat['nom'])."</h2>";
            echo "<p>".htmlspecialchars($plat['categorie'])."</p>";
            echo "<p>".htmlspecialchars($plat['prix'])." DH</p>";
            echo '</div>';
    ?>
    <form method="post">
        <button type="submit" name="action" value="increment" onclick="changerQuantite('increment')">+</button>
        <span id="quantite"><?= $quantite ?></span>
        <button type="submit" name="action" value="decrement" onclick="changerQuantite('decrement')">-</button>
        <input type="hidden" name="quantite" value="<?= $quantite; ?>" id="qtInput">
    </form>

    <?php
        endif;
    ?>
    <script src="script.js"></script>
</body>
</html>