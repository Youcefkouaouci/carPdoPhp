<?php
require_once("header.php");
require_once("connectDB.php");

$pass = password_hash("admin", PASSWORD_DEFAULT);
var_dump($pass);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['username'])) {
        $errors['username'] = 'Le username ne peut pas être vide.';
    }

    if (empty($_POST['password'])) {
        $errors['password'] = 'Le password ne peut pas être vide.';
    }

    if (empty($errors)) {
        require_once("connectDB.php");
        $pdo = connectDB();
        // $requete = $pdo->prepare("INSERT INTO user(username, ) VALUES(:username, :password);");
        $requete->execute([
            'username' => $_POST['username'],
            'password' => $_POST['password'],

        ]);
    }
}

?>
<form method="POST" action="login.php">
    <label>username</label>
    <input required type="text" name="username">

    <label>Password</label>
    <input required type="password" name="password">

    <button>Se Connecter</button>
</form>