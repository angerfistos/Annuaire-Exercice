<?php
include("admin-requestSQL.php");
session_start();

if (isset($_POST['bConfirm'])) {
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $password = md5(trim($_POST['password']));

    if (empty($username) || empty($password)) {
        setMessage('error', "Le nom d'utilisateur et le mot de passe sont obligatoires.");
        header("Location: ../pconnexion.php");
        exit;
    }

    if (checkUser($username, $password)) {
        setMessage('success', "Connexion réussie.");
        header("Location: ../paccueil.php");
        exit;
    } else {
        setMessage('error', "Nom d'utilisateur ou mot de passe incorrect.");
        header("Location: ../pconnexion.php");
        exit;
    }
}
?>