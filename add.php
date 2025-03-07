<?php
require_once("header.php");
require_once("connectDB.php");
?>
<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['model'])) {
        $errors['model'] = 'Le modèle ne peut pas être vide.';
    }

    if (empty($_POST['brand'])) {
        $errors['brand'] = 'La marque ne peut pas être vide.';
    }

    if (empty($_POST['horsePower']) || !is_numeric($_POST['horsePower'])) {
        $errors['horsePower'] = 'La puissance doit être un nombre valide.';
    }

    if (empty($_POST['image'])) {
        $errors['image'] = 'L\'image ne peut pas être vide.';
    }

    if (empty($errors)) {
        require_once("connectDB.php");
        $pdo = connectDB();
        $requete = $pdo->prepare("INSERT INTO car(model, brand, horsePower, image) VALUES(:model, :brand, :horsePower, :image);");
        $requete->execute([
            'model' => $_POST['model'],
            'brand' => $_POST['brand'],
            'horsePower' => $_POST['horsePower'],
            'image' => $_POST['image'],
        ]);
    }
    header("Location: index.php");
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
    <input type="text" name="image" required />
    <?php if (isset($errors['image'])) {
    ?>
        <p><?= $errors['image'] ?></p>
    <?php
    }
    ?>
    <input type="Submit" value="valider">
</form>