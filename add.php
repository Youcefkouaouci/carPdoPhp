<?php
require_once("header.php");
// Création d'un formulaire d'ajout
// validation des donnée POST avant formulaire 
// Ajouter en base données
// gestion des erreurs
// model, brand, horsePower, image
?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['model'])) {
        $errors['model'] = 'Le modèle ne peut pas être vide.';
    }

    if (empty($_POST['brand'])) {
        $errors['brand'] = 'Le modèle ne peut pas être vide.';
    }

    if (empty($_POST['horsePower'])) {
        $errors['horsePower'] = 'Le horsePower ne peut pas être vide.';
    }

    if (empty($_POST['image'])) {
        $errors['image'] = 'Le modèle ne peut pas être vide.';
    }

    if (empty($errors)) {
        require_once("connectDB.php");
        $pdo = connectDB();
    }
}

?>

<form method="POST" action="add.php">
    <label for="car">Ajouter votre Car</label>
    <?php

    ?>
    <input type="text" name="model" required />
    <?php if (isset($errors['model'])) {
    ?>
        <p><?= $errors['model'] ?></p>
    <?php
    }
    ?>
    <input type="text" name="brand" required />
    <?php if (isset($errors['brand'])) {
    ?>
        <p><?= $errors['brand'] ?></p>
    <?php
    }
    ?>
    <input type="number" name="horsePower" required />
    <?php if (isset($errors['horsePower'])) {
    ?>
        <p><?= $errors['horsePower'] ?></p>
    <?php
    }
    ?>
    <input type="file" name="image" required />
    <?php if (isset($errors['image'])) {
    ?>
        <p><?= $errors['image'] ?></p>
    <?php
    }
    ?>

    <?php
    // }
    ?>
    <input type="Submit" value="valider">
</form>
<?php
