<?php
require_once("header.php");
require_once("connectDB.php");

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
}

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
        $requete = $pdo->prepare("INSERT INTO car(model,  brand, horsePower, image) VALUES(:model, :brand, :horsePower, :image);");
        $requete->execute([
            'model' => $_POST['model'],
            'brand' => $_POST['brand'],
            'horsePower' => $_POST['horsePower'],
            'image' => $_POST['image'],
        ]);
    }
    // header("Location: index.php");
}
?>

<div class="container mt-5">
    <h2 class="mb-4">Ajouter une voiture</h2>

    <form method="POST" action="add.php" class="border p-4 rounded shadow bg-light">
        <div class="mb-3">
            <label class="form-label">Modèle :</label>
            <input type="text" name="model" class="form-control" required />
            <?php if (isset($errors['model'])) {
            ?>
                <p class="text-danger"><?= $errors['model'] ?></p>
            <?php
            }
            ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Marque :</label>
            <input type="text" name="brand" class="form-control" required />
            <?php if (isset($errors['brand'])) {
            ?>
                <p class="text-danger"><?= $errors['brand'] ?></p>
            <?php
            }
            ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Puissance :</label>
            <input type="number" name="horsePower" class="form-control" required />
            <?php if (isset($errors['horsePower'])) {
            ?>
                <p class="text-danger"><?= $errors['horsePower'] ?></p>
            <?php
            }
            ?>
        </div>

        <div class="mb-3">
            <label class="form-label">Image :</label>
            <input type="text" name="image" class="form-control" required />
            <?php if (isset($errors['image'])) {
            ?>
                <p class="text-danger"><?= $errors['image'] ?></p>
            <?php
            }
            ?>
        </div>

        <button type="submit" class="btn btn-primary">Valider</button>
        <a href="index.php" class="btn btn-secondary">Annuler</a>

    </form>

    <?php
    require_once("footer.php");
    ?>