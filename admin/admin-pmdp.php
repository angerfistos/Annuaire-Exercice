<?php
session_start();
require('admin-requestSQL.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'] ?? '';
    $secretQuestion = $_POST['secret-question'] ?? ''; // Utilisation de guillemets pour les clés de tableau
    $secretAnswer = $_POST['secret-answer'] ?? '';
    $newPassword = $_POST['new-password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    // Vérifier si les mots de passe correspondent
    if ($newPassword !== $confirmPassword) {
        $_SESSION['message'] = "Les mots de passe ne correspondent pas.";
        header("Location: ../pmdp.php");
        exit;
    }

    // Appeler la fonction de réinitialisation du mot de passe
    $resetResult = resetPassword($username, $secretQuestion, $secretAnswer, $newPassword);

    if ($resetResult) {
        $_SESSION['message'] = "Mot de passe réinitialisé avec succès.";
        header("Location: ../pconnexion.php");
    } else {
        $_SESSION['message'] = "Erreur lors de la réinitialisation du mot de passe.";
        header("Location: ../pmdp.php");
    }
} else {
    // Rediriger vers le formulaire si la méthode n'est pas POST
    header("Location: ../pmdp.php");
}
exit;
?>