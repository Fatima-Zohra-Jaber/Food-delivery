<?php
    session_start();
    
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    try{
        $conn = new PDO("mysql:host=localhost;dbname=solirestaurant", "root", 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmtPlats = $conn->query("SELECT * FROM plat");  // Utilisé pour des requêtes simples sans paramètres,elle est plus direct et rapide, mais moins flexible.
        $plats = $stmtPlats->fetchAll(PDO::FETCH_ASSOC); 

        // $stmt = $conn->prepare($sql);                    Utilisé pour des requêtes avec  
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);    des paramètres dynamiques 
        // $stmt->execute();                                ou requêtes paramétrées,
        // $plats = $stmt->fetchAll(PDO::FETCH_ASSOC);      pour plus de sécurité.


    }catch(PDOException $e){
        die ("Connexion échouée: " . $e->getMessage());
    }

    function calculTotal(){ 
        $total = 0;
        foreach($_SESSION['panier'] as $plat){
            $total += $plat['prix'] * $plat['quantite'];
        }
        return $total;
    }
   
?>