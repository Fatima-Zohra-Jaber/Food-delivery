<?php 
    session_start();
    if(isset($_POST['connect'])){
        if($_POST['nom'] == 'admin' && $_POST['password'] == 'admin'){
            $_SESSION['admin'] = 'admin';
            header('Location: dashboard.php');
            exit();
        }else{
            echo "<div class='alert alert-danger text-center'>Identifiants incorrects</div>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>Admin connexion</title>
</head>
<body>

    <div class="test col-md-10 mx-auto my-auto col-lg-4 p-4 p-md-5 border rounded-3 bg-body-tertiary">
        <h1>Admin connexion</h1>
        <form action="index.php" method="POST" class="mt-5">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom d'utilisateur">
                <label for="nom">Nom d'utilisateur</label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe">
                <label for="floatingPassword">Mot de passe</label>
            </div>
            <input type="submit"  name="connect" value="Se connecter" class="w-50 btn btn-lg btn-primary"/>
        </form>
    </div>
</body>
</html>