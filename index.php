<?php
require_once("header.php");

// Récupération des données
require_once("connectDB.php");
$pdo = connectDB();
$requete = $pdo->prepare("SELECT * FROM car;");
$requete->execute();
$cars = $requete->fetchAll();

// affichage des données
?>
<h2>Liste des Voitures</h2>
<?php foreach ($cars as $car) {
?>
    <div class="d-flex flex-wrap justify-content-evenly">
        <h3 class="col-4">Modèle: <?= $car['model'] ?></h3>
        <p class="col-4">Marque: <?= $car['brand'] ?></p>
        <p class="col-4">Puissance: <?= $car['horsePower'] ?></p>
        <a class="btn btn-primary" href="update.php?id=<?= $car["id"] ?>">Modifier</a>
        <a class="btn btn-danger" href="delete.php?id=<?= $car["id"] ?>">Supprimer</a>
        <?php if (!empty($car['image'])) {
        ?>
            <img src="images/<?= $car['image'] ?>" alt="<?= $car['model'] ?>">
        <?php } else { ?>
            <p>Aucune image disponible</p>
        <?php } ?>
    </div>
<?php } ?>

<button class="btn btn-success"><a href="add.php">Ajouter une voiture</a></button>