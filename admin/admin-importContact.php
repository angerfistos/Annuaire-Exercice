<?php
session_start(); 
include('admin-requestSQL.php'); 

if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK && isset($_POST['userId'])) {
    $filePath = $_FILES['file']['tmp_name'];
    $userId = $_POST['userId'];

    // Ici, vous pouvez ajouter des validations supplémentaires si nécessaire

    // Appel de la fonction d'importation
    if (importCSVToDatabase($filePath, $userId)) {
        $_SESSION['message'] = 'Importation réussie.';
        header('Location: ../paccueil.php');
    } else {
        $_SESSION['message'] = 'Échec de l\'importation.';
        header('Location: ../paccueil.php'); // Redirige vers une autre page si nécessaire
    }
} else {
    // Gestion des erreurs de téléchargement
    if (isset($_FILES['file'])) {
        $_SESSION['message'] = 'Erreur de téléchargement : ' . $_FILES['file']['error'];
    } else {
        $_SESSION['message'] = 'Erreur de téléchargement du fichier.';
    }
    header('Location: ../paccueil.php'); // Redirige vers une autre page si nécessaire
}
exit();
?>