<?php
    try{
        $conn = new PDO("mysql:host=localhost;dbname=solirestaurant", "root", 'root');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmtPlats = $conn->query("SELECT * FROM plat");  //Utilisé pour des requêtes simples sans paramètres, est plus direct et rapide, mais moins flexible.
        $plats = $stmtPlats->fetchAll(PDO::FETCH_ASSOC); 

        // $stmt = $conn->prepare($sql);                    Utilisé pour des requêtes avec  
        // $stmt->bindParam(':id', $id, PDO::PARAM_INT);    des paramètres dynamiques 
        // $stmt->execute();                                ou requêtes paramétrées,
        // $plats = $stmt->fetchAll(PDO::FETCH_ASSOC);      pour plus de sécurité.


    }catch(PDOException $e){
        die ("Connexion échouée: " . $e->getMessage());
    }
    
    