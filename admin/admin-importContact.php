<?php
session_start(); 
include('admin-requestSQL.php'); 

if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK && isset($_POST['userId'])) {
    $filePath = $_FILES['file']['tmp_name'];
    $userId = $_POST['userId'];

    // Appel de la fonction d'importation
    if (importCSVToDatabase($filePath, $userId)) {
        setMessage('success', 'Importation réussie.');
    } else {
        setMessage('error', 'Échec de l\'importation.');
    }
} else {
    // Gestion des erreurs de téléchargement
    if (isset($_FILES['file'])) {
        $errorMsg = 'Erreur de téléchargement : ' . $_FILES['file']['error'];
    } else {
        $errorMsg = 'Erreur de téléchargement du fichier.';
    }
    setMessage('error', $errorMsg);
}

header('Location: ../paccueil.php');
exit();
?>