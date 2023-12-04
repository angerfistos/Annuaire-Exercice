<?php
session_start();
require('admin-requestSQL.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $secretQuestion = $_POST['secret-question'] ?? '';
    $secretAnswer = $_POST['secret-answer'] ?? '';
    $newPassword = $_POST['new-password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    // Vérifier si les champs sont vides
    if (empty($username) || empty($secretQuestion) || empty($secretAnswer) || empty($newPassword) || empty($confirmPassword)) {
        setMessage('error', "Tous les champs marqués d'un * sont obligatoires.");
        header("Location: ../pmdp.php");
        exit;
    }

    // Vérifier si les mots de passe correspondent
    if ($newPassword !== $confirmPassword) {
        setMessage('error', "Les mots de passe ne correspondent pas.");
        header("Location: ../pmdp.php");
        exit;
    }

    $resetResult = resetPassword($username, $secretQuestion, $secretAnswer, $newPassword);

    switch ($resetResult) {
        case 'success':
            setMessage('success', "Votre mot de passe a été réinitialisé avec succès.");
            header("Location: ../pconnexion.php"); // Assurez-vous que ce chemin est correct
            break;

        case 'question_mismatch':
            setMessage('error', "La question secrète ne correspond pas à celle enregistrée.");
            header("Location: ../pmdp.php"); // Assurez-vous que ce chemin est correct
            break;

        case 'answer_mismatch':
            setMessage('error', "La réponse à la question secrète est incorrecte.");
            header("Location: ../pmdp.php"); // Assurez-vous que ce chemin est correct
            break;

        case 'error':
        default:
            setMessage('error', "Une erreur est survenue lors de la réinitialisation du mot de passe.");
            header("Location:../ pmdp.php"); // Assurez-vous que ce chemin est correct
            break;
    }
}
?>