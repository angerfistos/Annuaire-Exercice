<?php
require("admin-requestSQL.php");
$title = "Page d'inscription - PhoneBook";
include('../partials/header.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['bInscription'])) {
    $nom = htmlspecialchars(strtolower(trim($_POST['nom'])));
    $prenom = htmlspecialchars(strtolower(trim($_POST['prenom'])));
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $dateDeNaissance = htmlspecialchars(strtolower(trim($_POST['dateDeNaissance'])));
    $email1 = htmlspecialchars(strtolower(trim($_POST['email1'])));
    $email2 = htmlspecialchars(strtolower(trim($_POST['email2'])));
    $password1 = md5(htmlspecialchars(strtolower(trim($_POST['password1']))));
    $password2 = md5(htmlspecialchars(strtolower(trim($_POST['password2']))));
    $questionSecrete = htmlspecialchars(strtolower(trim($_POST['questionSecrete']))); 
    $reponseSecrete = htmlspecialchars(strtolower(trim($_POST['reponseSecrete'])));

    $errors = [];
    if (empty($password1)) {
        $errors[] = 'Veuillez entrer un mot de passe.';
    }
    if (empty($password2)) {
        $errors[] = 'Veuillez confirmer votre mot de passe.';
    }
    if ($password1 !== $password2) {
        $errors[] = 'Les mots de passe ne correspondent pas.';
    }
    if (empty($nom)) {
        $errors[] = 'Veuillez entrer votre nom.';
    }
    if (empty($prenom)) {
        $errors[] = 'Veuillez entrer votre prénom.';
    }
    if (empty($username)) {
        $errors[] = 'Veuillez entrer un nom d\'utilisateur.';
    }
    if (empty($questionSecrete)) {
        $errors[] = 'Veuillez choisir une question secrète.';
    }
    if (empty($reponseSecrete)) {
        $errors[] = 'Veuillez répondre à la question secrète.';
    }
    if ($email1 != $email2) {
        $errors[] = 'Les adresses e-mail ne correspondent pas.';
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = '<div class="mt-4 alert error" role="alert">
            <div class="mx-8 bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Erreur:
            </div>
            <div class="mx-8 border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">' . 
            implode("<br>", $errors) . 
            '</div>
        </div>';
        header("Location: ../pinscription.php");
        exit;
    } else {
        // Si aucune erreur, procéder à l'inscription
        $msg = insertdata($nom, $prenom, $username, $password1, $email1, $questionSecrete, $reponseSecrete);
        $_SESSION['message'] = $msg;
        header('Location: ../pconnexion.php');
        exit;
    }
}
?>