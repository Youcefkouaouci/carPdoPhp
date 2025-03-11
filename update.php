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

// var_dump($car);

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


<div class="container mt-5">
    <h2 class="mb-4">Modifier la voiture</h2>

    <form method="" action="update.php">

        <div class="mb-3">
            <label class="form-label">Modèle :</label>
            <input type="text" name="model" class="form-control" value="<?= $car['model'] ?>" required />
            <?php if (isset($errors['model'])) {
            ?>
                <p class="text-danger"><?= $errors['model'] ?></p>
            <?php
            }
            ?>
        </div>
        <div class="mb-3">
            <input type="text" name="brand" class="form-control" value="<?= $car['brand'] ?>" required />
            <?php if (isset($errors['brand'])) {
            ?>
                <p class="text-danger"><?= $errors['brand'] ?></p>
            <?php
            }
            ?>
        </div>
        <div class="mb-3">
            <input type="number" name="horsePower" class="form-control" value="<?= $car['horsePower'] ?>" required />
            <?php if (isset($errors['horsePower'])) {
            ?>
                <p class="text-danger"><?= $errors['horsePower'] ?></p>
            <?php
            }
            ?>
        </div>
        <div class="mb-3">
            <input type="text" name="image" class="form-control" value="<?= $car['image'] ?>" required />
            <?php if (isset($errors['image'])) {
            ?>
                <p class="text-danger"><?= $errors['image'] ?></p>
            <?php
            }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>
    </form>
</div>