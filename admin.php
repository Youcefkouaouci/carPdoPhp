<?php
require_once("header.php");

// session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}

// Récupération des données
require_once("connectDB.php");
$pdo = connectDB();
$requete = $pdo->prepare("SELECT * FROM car;");
$requete->execute();
$cars = $requete->fetchAll();

// affichage des données
?>
<div class="container mt-4">
    <h2 class="text-center mb-4">Liste des Voitures</h2>
    <div class="row">
        <?php foreach ($cars as $car) {
        ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <h3 class="card-title text-center">Modèle: <?= $car['model'] ?></h3>
                    <p class="card-text">Marque: <?= $car['brand'] ?></p>
                    <p class="card-text">Puissance: <?= $car['horsePower'] ?></p>
                    <a class="btn btn-primary" href="update.php?id=<?= $car["id"] ?>">Modifier</a>
                    <a class="btn btn-danger" href="delete.php?id=<?= $car["id"] ?>">Supprimer</a>
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
    <div class="text-center mt-4">
        <a class="btn btn-success" href="add.php">Ajouter une voiture</a>
    </div>
</div>

<?php
require_once("footer.php");
?>