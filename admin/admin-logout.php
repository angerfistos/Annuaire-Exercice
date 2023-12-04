<?php 
session_start();
include('admin-requestSQL.php'); 

// Utiliser setMessage pour définir le message de déconnexion
setMessage('success', 'Déconnexion réussie. À bientôt!');

// Supprimer les données spécifiques de l'utilisateur de la session
unset($_SESSION['utilisateurID']);
unset($_SESSION['nom']);
unset($_SESSION['prenom']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['password']);

// Rediriger vers la page d'accueil
header('Location: ../index.php');
exit;
?>