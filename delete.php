<?php
require_once("header.php");
require_once("connectDB.php");

var_dump($_GET['id']);

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

    $pdo = connectDB();
    $requete = $pdo->prepare("DELETE FROM Car WHERE id = :id;");
    $requete->execute([
        'id' => $_GET["id"]
    ]);
    var_dump("test");
    header("Location: index.php");
}
?>

<form method="POST" action="delete.php?id=<?= $_GET["id"] ?>">

    <label for="car">Confirmez la suppresion de <?= $car['model'], $car['brand']  ?> </label>
    <Button>Supprimer</Button>
    <button formaction="index.php">Annuler</button>
</form>