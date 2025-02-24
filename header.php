<?php
// include 'config.php';
?>
 <link rel="icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="__className_d65c78 modal-open" cz-shortcut-listen="true" style="overflow: hidden; padding-right: 19px;" data-rr-ui-modal-open> 
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="/_next/static/chunks/webpack-eb157f80fef19505.js" async=""></script>
    <script> (self.__next_f=self.__next_f||[]).push([0]);self.__next_f.push([2,null]) </script>
<header class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
       <div class="col-md-3 mb-2 mb-md-0">
            <a href="" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
                <img src="images/logo.png" alt="Logo"  class="bi me-2" >
                <span class="fs-4">SoliFoods</span> 
            </a>
       </div>
       <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href='index.php' class="nav-link px-2 link-secondary">Accueil</a></li>
            <li><a href='plats.php' class="nav-link px-2 link-secondary">Notre Plats</a></li>
            <?php
                if(isset($_SESSION['client'])){
                    echo "<li><a href='commandes.php' class='nav-link px-2 link-secondary'>Mes Commandes</a></li>";
                }
            ?>
            <li><a href='contact.php' class="nav-link px-2 link-secondary">Contact</a></li>
        </ul>
                
        <div id='profil' >
            
            <?php
                if(isset($_SESSION['client'])){
                    ?>
                    <div class="list-inline">
                    <div role="button" class="me-5 text-muted position-relative  list-inline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                            </path></svg>
                            <span class="custom-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">4</span>
                        </div>
                        <div role="button" class="me-5 text-muted position-relative  list-inline-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            <span class="custom-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">4</span>
                        </div>
                    </div>
                    <?php
                    echo "<a href='favorite.php'>Favorite</a>";
                    echo "<a href='panier.php'>Mon panier</a>";
            ?>
            <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- <svg class="bi d-block mx-auto mb-1" width="32" height="32" >
                        <use xlink:href="#people-circle"></use>
                    </svg> -->
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle">
                    <?=$_SESSION['client']['nomCl']?>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    <li><a href="#" class="dropdown-item">Profile</a></li>
                    <li><a href="#" class="dropdown-item">Paramètre</a></li>

                    <li><hr class="dropdown-divider"></li>
                    <li><a href="logout.php" class="dropdown-item">Deconnecter</a></li>
                </ul>
            </div>
            <?php 
                    // echo "<p>{}</p>";
                }else{ 
            ?>
            <div class="col-md-3 text-end d-flex">
                <a href="login.php" class="btn btn-outline-danger me-2">Se connecter</a>
                <a href="inscription.php" class="btn btn-danger">S'inscrire</a>
            </div>
            <?php  } ?>
        </div>
    </header>
   