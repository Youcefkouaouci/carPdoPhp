<?php
require_once("header.php");
require_once("header.php");

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
<h2>Liste des Voitures</h2>
<?php foreach ($cars as $car) {
?>
    <div>
        <h3>Modèle: <?= $car['model'] ?></h3>
        <p>Marque: <?= $car['brand'] ?></p>
        <p>Puissance: <?= $car['horsePower'] ?></p>
        <a href="update.php?id=<?= $car["id"] ?>">Modifier</a>
        <a href="delete.php?id=<?= $car["id"] ?>">Supprimer</a>
        <?php if (!empty($car['image'])) {
        ?>
            <img src="images/<?= $car['image'] ?>" alt="<?= $car['model'] ?>">
        <?php } else { ?>
            <p>Aucune image disponible</p>
        <?php } ?>
    </div>
<?php } ?>

<button><a href="add.php">Ajouter une voiture</a></button>