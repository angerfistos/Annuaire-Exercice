<?php
require('admin-requestSQL.php');
session_start();

if (isset($_POST['bInscription'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $username = strtolower(trim($_POST['username']));
    $password = $_POST['password1'];
    $confirmPassword = $_POST['password2'];
    $email = trim($_POST['email1']);
    $confirmEmail = trim($_POST['email2']);
    $questionSecrete = trim($_POST['questionSecrete']);
    $reponseSecrete = trim($_POST['reponseSecrete']);

    if (empty($password) || empty($email) || empty($questionSecrete) || empty($reponseSecrete)) {
        $_SESSION['formData'] = [
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,
            'email' => $email
        ];
        setMessage('error', "Tous les champs marqués d'un * sont obligatoires.");
        header("Location: ../pinscription.php");
        exit;
    }

    if ($email !== $confirmEmail) {
        setMessage('error', "Les emails ne correspondent pas.");
        header("Location: ../pinscription.php");
        exit;
    }

    if ($password !== $confirmPassword) {
        setMessage('error', "Les mots de passe ne correspondent pas.");
        header("Location: ../pinscription.php");
        exit;
    }

    $insertResult = insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete);
    if ($insertResult === true) {
        unset($_SESSION['formData']);
        setMessage('success', "Votre compte a bien été créé.");
        header("Location: ../pconnexion.php");
        exit;
    } else {
        $_SESSION['formData'] = [
            'nom' => $nom,
            'prenom' => $prenom,
            'username' => $username,
            'email' => $email
        ];
        if ($insertResult === 'username_exists') {
            setMessage('error', "Ce nom d'utilisateur est déjà utilisé.");
        } elseif ($insertResult === 'email_exists') {
            setMessage('error', "Cet e-mail est déjà utilisé.");
        } else {
            setMessage('error', "Erreur lors de l'inscription. Veuillez réessayer.");
        }
        header("Location: ../pinscription.php");
        exit;
    }
}
?>