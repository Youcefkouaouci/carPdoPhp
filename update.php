<?php
require_once("header.php");
require_once("connectDB.php");

$_GET['id'];

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}

// isset verfier si l'id existe 
if (isset($_GET['id']) === false) {
    header("Location: index.php");
}
// verfier si une voiture avec l'id existe en bdd
$pdo = connectDB();
$requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
$requete->execute([

    'id' => $_GET["id"]
]);
$car = $requete->fetch();

if ($car === false) {
    header("Location: index.php");
}

var_dump($car);

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
        $requete = $pdo->prepare("UPDATE Car SET model = :model, brand = :brand, horsePower = :horsePower, image = :image WHERE id = :id;");
        $requete->execute([

            'model' => $_POST['model'],
            'brand' => $_POST['brand'],
            'horsePower' => $_POST['horsePower'],
            'image' => $_POST['image'],
            'id' => $car["id"]
        ]);
    }
    header("Location: index.php");
}
?>



<form method="" action="update.php">
    <label for="car">Modifier votre Car</label>
    <?php

    ?>
    <input type="text" name="model" value="<?= $car['model'] ?>" required />
    <?php if (isset($errors['model'])) {
    ?>
        <p><?= $errors['model'] ?></p>
    <?php
    }
    ?>
    <input type="text" name="brand" value="<?= $car['brand'] ?>" required />
    <?php if (isset($errors['brand'])) {
    ?>
        <p><?= $errors['brand'] ?></p>
    <?php
    }
    ?>
    <input type="number" name="horsePower" value="<?= $car['horsePower'] ?>" required />
    <?php if (isset($errors['horsePower'])) {
    ?>
        <p><?= $errors['horsePower'] ?></p>
    <?php
    }
    ?>
    <input type="text" name="image" value="<?= $car['image'] ?>" required />
    <?php if (isset($errors['image'])) {
    ?>
        <p><?= $errors['image'] ?></p>
    <?php
    }
    ?>
    <input type="Submit" value="valider">
</form>