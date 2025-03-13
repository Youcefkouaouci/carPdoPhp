<?php
require_once("header.php");
require_once("connectDB.php");
// var_dump($_GET['id']);

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

    $pdo = connectDB();
    $requete = $pdo->prepare("DELETE FROM Car WHERE id = :id;");
    $requete->execute([
        'id' => $_GET["id"]
    ]);
    var_dump("test");
    header("Location: index.php");
}
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h2 class="text-danger mb-4">Suppression de voiture</h2>
                    <p class="fs-5">Êtes-vous sûr de vouloir supprimer :</p>
                    <form method="POST" action="delete.php?id=<?= $_GET["id"] ?>">
                        <label for="car">Confirmez la suppresion de <?= $car['model'], $car['brand']  ?> </label>
                        <Button class="btn btn-danger w-100 mb-2">Supprimer</Button>
                        <button class="btn btn-secondary w-100" formaction="index.php">Annuler</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>