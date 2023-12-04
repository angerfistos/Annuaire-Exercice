<?php
require("admin-requestSQL.php");
$title = "Ajouter un Contact - PhoneBook";
include('../partials/header.php');

session_start();

if(isset($_POST["btnAjouterContact"])){ 
    // Récupération de l'ID de l'utilisateur connecté et des données du formulaire
    $utilisateurID = $_SESSION['utilisateurID'];
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $adresse = htmlspecialchars(trim($_POST['adresse']));
    $entreprise = htmlspecialchars(trim($_POST['entreprise']));
    $dateDeNaissance = htmlspecialchars(trim($_POST['dateDeNaissance']));
    $note = htmlspecialchars(trim($_POST['note'])); 

    // Validation des champs obligatoires marqués d'un astérisque
    if (empty($nom) || empty($prenom) || empty($telephone)) {
        setMessage('error', 'Tous les champs marqués d\'un * sont obligatoires.');
        header('Location: ../paddcontact.php');
        exit;
    }

    // Appel de la fonction pour insérer les données
    if (insertContact($utilisateurID, $nom, $prenom, $telephone, $email, $adresse, $entreprise, $dateDeNaissance, $note)) {
        setMessage('success', 'Contact ajouté avec succès.');
        header('Location: ../paccueil.php');
    } else {
        setMessage('error', 'Erreur lors de l\'ajout du contact.');
        header('Location: ../paddcontact.php');
    }
    exit;
}
?>