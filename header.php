<?php
// include 'config.php';
?>
    <!-- <link rel="icon" href="images/logo.png" type="image/png"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="mx-4 d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
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
                
            
        <?php if(isset($_SESSION['client'])){ ?>
            <div class="list-inline d-flex justify-content-center">
                <div role="button" class="me-4 text-muted position-relative  list-inline-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                        </path>
                    </svg>
                        <span class="custom-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">4</span>
                </div>
                <div role="button" class="me-4 text-muted position-relative  list-inline-item" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                    <span class="custom-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">1</span>
                </div>
                     
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                        data-bs-toggle="dropdown"  id="dropdownMenuButton">
                        <img src="images/profil.svg" alt="Profil">
                        <?=$_SESSION['client']['nomCl']?>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li><a href="#" class="dropdown-item">Profile</a></li>
                        <li><a href="#" class="dropdown-item">Paramètre</a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a href="logout.php" class="dropdown-item">Déconnexion</a></li>
                    </ul>
                </div>
            </div>
            <?php }else{ ?>
            <div class="col-md-3 text-end d-flex">
                <a href="login.php" class="btn btn-outline-danger me-2">Se connecter</a>
                <a href="inscription.php" class="btn btn-danger">S'inscrire</a>
            </div>
            <?php  } ?>
    </header>
   