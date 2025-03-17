<?php
require_once("header.php");
require_once("connectDB.php");

// $pdo = connectDB(); 
function selectAllCars($pdo)
{
    $requete = $pdo->prepare("SELECT * FROM car");
    $requete->execute();
    return $requete->fetchAll(); 
}
// var_dump(selectAllCars($pdo));

function selectCarByID($pdo)
{
    $requete = $pdo->prepare("SELECT * FROM car WHERE id = :id;");
    $requete->execute([
        ":id" => 1
    ]);
    return $requete->fetch();
}

// var_dump(selectCarByID($pdo));

function insertCar($pdo)
{
    $requete = $pdo->prepare("INSERT INTO car(model, brand, horsePower, image) VALUES(:model, :brand, :horsePower, :image);");
    $requete->execute([
        'model' => $_POST['model'],
        'brand' => $_POST['brand'],
        'horsePower' => $_POST['horsePower'],
        'image' => $_POST['image'],
    ]);
}
// var_dump(insertCar($pdo));
