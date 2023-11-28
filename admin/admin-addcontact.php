<?php
require("admin-requestSQL.php");
$title = "Ajouter un Contact - PhoneBook";
include('../partials/header.php');

session_start();

if(isset($_POST["btnAjouterContact"])){ 
    // Récupération de l'ID de l'utilisateur connecté
    $utilisateurID = $_SESSION['utilisateurID'];

    // Récupération des données du formulaire
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $entreprise = htmlspecialchars(trim($_POST['entreprise']));
    $dateDeNaissance = htmlspecialchars(trim($_POST['dateDeNaissance']));
    $note = htmlspecialchars(trim($_POST['note'])); 

    $errors = [];

    // Validation des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($telephone)) {
        $errors[] = 'Les champs nom, prénom et téléphone sont obligatoires.';
    }

    // Gestion des erreurs
    if (!empty($errors)) {
        $_SESSION['message'] = implode('<br>', $errors);
        header('Location: ../paddcontact.php');
        exit;
    }

    // Appel de la fonction pour insérer les données
    $msg = insertContact($utilisateurID, $nom, $prenom, $telephone, $email, $adresse, $entreprise, $dateDeNaissance, $note); 
    $_SESSION['message'] = $msg;

    // Redirection après l'ajout du contact
    header('Location: ../paccueil.php');
    exit;
}
?>