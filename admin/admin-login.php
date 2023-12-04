<?php
include ("admin-requestSQL.php");
session_start();

if (isset($_POST['bConfirm'])) {
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $password = md5(trim($_POST['password']));  // Utilisation de md5 pour le mot de passe

    // Vérifier si les champs username et password sont remplis
    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "Le nom d'utilisateur et le mot de passe sont obligatoires.";
        header("Location: ../pconnexion.php");
        exit;
    }

    $userExists = checkUser($username, $password);

    if ($userExists) {
        // Redirection immédiate vers la page d'accueil après la connexion réussie
        header("Location: ../paccueil.php");
        exit;
    } else {
        $_SESSION['message'] = "Nom d'utilisateur ou mot de passe incorrect.";
        header("Location: ../pconnexion.php");
        exit;
    }
}
?>