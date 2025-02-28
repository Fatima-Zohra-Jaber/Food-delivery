<?php
    require 'config.php';

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant</title>

    <?php include 'header.php'; ?>
    
    <main>
       <!-- Plats Section -->
       <section id="hero" class="container d-flex flex-wrap align-items-center justify-content-center">
            <img src="images/banner.jpeg" alt="" width="100%">
        </section>
            
        <!-- Cart Section -->
        <?php  include 'panier.php'; ?>
    </main>
    
       
    <?php include 'footer.php'; ?>

    
</body>
</html>

