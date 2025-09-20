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
    
    <main class="container">
        <!-- Hero Section -->
        <div id="carouselExampleCaptions" class="carousel slide" style=" height: calc(100vh - 20%);">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="images/banner1.jpg" class="d-block w-100 rounded" alt="..." style="height:400px;object-fit:cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Bienvenue chez SoliFoods</h5>
                    <p class="lead">Découvrez nos plats variés et savoureux, préparés avec passion.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="images/banner2.jpeg" class="d-block w-100 rounded" alt="..." style="height:400px;object-fit:cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Cuisine du Monde</h5>
                    <p>Voyagez à travers les saveurs internationales sans quitter votre table.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="images/banner3.webp" class="d-block w-100 rounded" alt="..." style="height:400px;object-fit:cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Commandez en ligne</h5>
                    <p>Profitez d’une livraison rapide et d’un service de qualité, chez vous.</p>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
        </div>  
        <!-- Nouvelle section avantages -->
        <section class="container my-5">
            <h2 class="text-center fw-bold mb-4 text-danger">Pourquoi choisir SoliFoods ?</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-star-fill text-warning display-5 mb-3"></i>
                            <h5 class="card-title">Qualité supérieure</h5>
                            <p class="card-text">Des ingrédients frais et des plats préparés avec soin pour une expérience gustative unique.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-truck text-danger display-5 mb-3"></i>
                            <h5 class="card-title">Livraison rapide</h5>
                            <p class="card-text">Commandez en ligne et recevez vos plats chauds en un temps record, partout en ville.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body text-center">
                            <i class="bi bi-list-ul text-success display-5 mb-3"></i>
                            <h5 class="card-title">Grande variété</h5>
                            <p class="card-text">Un large choix de cuisines et de plats pour satisfaire toutes les envies et tous les goûts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section avis clients -->
        <section class="container my-5">
            <h2 class="text-center fw-bold mb-4 text-danger">Avis de nos clients</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="images/profil.svg" alt="Client 1" class="rounded-circle mb-3" width="60" height="60">
                            <h5 class="card-title mb-1">Fatima E.</h5>
                            <p class="card-text fst-italic">“Service rapide et plats délicieux, je recommande vivement SoliFoods !”</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="images/profil.svg" alt="Client 2" class="rounded-circle mb-3" width="60" height="60">
                            <h5 class="card-title mb-1">Yassine B.</h5>
                            <p class="card-text fst-italic">“Un large choix de plats et une qualité toujours au rendez-vous.”</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body text-center">
                            <img src="images/profil.svg" alt="Client 3" class="rounded-circle mb-3" width="60" height="60">
                            <h5 class="card-title mb-1">Sofia L.</h5>
                            <p class="card-text fst-italic">“Livraison très rapide et équipe très professionnelle, merci !”</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Cart Section -->
        <?php  include 'panier.php'; ?>
    </main>
    
       
    <?php include 'footer.php'; ?>

    
</body>
</html>

