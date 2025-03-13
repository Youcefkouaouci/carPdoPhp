<?php
// Inclusion des fichiers nécessaires
require_once("header.php");
require_once("connectDB.php");

// Récupération des données, connecter à la BD et cibler les données fetchAll pour récuprer l'ensemble des données, fetch() pour récuprer une seul données

// Connexion à la base de données
$pdo = connectDB();

// Préparation et exécution de la requête SQL pour récupérer toutes les voitures
$requete = $pdo->prepare("SELECT * FROM car;");
$requete->execute();

// Récupération des résultats sous forme de tableau associatif
$cars = $requete->fetchAll();

// affichage des données 
/*foreach permet d'excuter les elements de table array as value {code dedans}*/
?>
<div class="container mt-4">

    <h2 class="text-center mb-4">Liste des Voitures</h2>

    <div class="row">

        <!-- Boucle pour afficher chaque voiture -->
        <?php foreach ($cars as $car) {
        ?>
            <div class="col-md-6 col-lg-4 mb-4">

                <div class="card shadow-sm">
                    <h3 class="card-title text-center">Modèle: <?= $car['model'] ?></h3>

                    <p class="card-text">Marque: <?= $car['brand'] ?></p>
                    <p class="card-text">Puissance: <?= $car['horsePower'] ?></p>

                    <?php if (!empty($car['image'])) {
                    ?>
                        <img src="images/<?= $car['image'] ?>" class="card-img-top img-fluid" alt="<?= $car['model'] ?>" style="height: 200px; object-fit: cover;">
                    <?php } else { ?>
                        <p class="text-center p-3 bg-light">Aucune image disponible</p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- la fonction ADD Article réservé que au Admin en session Connecté = commented elements -->
    <div class="text-center mt-4">
        <!-- <button class="btn btn-success">
            <a href="add.php" class="text-white text-decoration-none d-block">Ajouter une voiture</a>
        </button> -->
    </div>

</div>