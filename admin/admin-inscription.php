<?php
require('admin/admin-requestSQL.php');
session_start();

if (isset($_POST['bInscription'])) {
    // Récupérer et valider les données
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $username = strtolower(trim($_POST['username']));  // Même normalisation que dans la connexion
    $password = $_POST['password1'];
    $confirmPassword = $_POST['password2'];
    $email = trim($_POST['email1']);
    $confirmEmail = trim($_POST['email2']);
    $questionSecrete = trim($_POST['questionSecrete']);
    $reponseSecrete = trim($_POST['reponseSecrete']);

    // Vérifier la correspondance des emails et des mots de passe
    if ($email !== $confirmEmail || $password !== $confirmPassword) {
        $_SESSION['message'] = "Les emails ou les mots de passe ne correspondent pas.";
        header("Location: pinscription.php");
        exit;
    }

    // Appel à la fonction d'insertion
    $result = insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete);

    // Gérer le résultat de l'insertion
    $_SESSION['message'] = $result;
    header("Location: ../pinscription.php");
    exit;
}
?>