<?php
require_once("header.php");
require_once("connectDB.php");

// la syntaxe pour hasher le password dans la BDD
$pass = password_hash("admin", PASSWORD_DEFAULT);
// var_dump($pass);
// récuprer les 
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
        $requete = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $requete->execute([
            'username' => $_POST['username'],
        ]);
        $user = $requete->fetch();

        if ($user != false) {
            if (password_verify($_POST["password"], $user["password"])) {
                session_start();
                $_SESSION["username"] = $user["username"];
                header("Location: admin.php");
            }
        }
    } else {
        echo ("Nom d'utilisateur ou mot de passe incorrect.");
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h2 class="text-center mb-4">Connexion</h2>
                    <form method="POST" action="login.php">
                        <div>
                            <label class="form-label">Username</label>
                            <input type="text"
                                name="username"
                                class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password"
                                name="password"
                                class="form-control"
                                required />
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary w-100">Se Connecter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>