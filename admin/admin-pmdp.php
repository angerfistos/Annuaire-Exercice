<?php
session_start();
require('admin-requestSQL.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $secretQuestion = $_POST['secret-question'] ?? '';
    $secretAnswer = $_POST['secret-answer'] ?? '';
    $newPassword = $_POST['new-password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

    if ($newPassword !== $confirmPassword) {
        setMessage('error', "Les mots de passe ne correspondent pas.");
        header("Location: ../pmdp.php");
        exit;
    }

    $resetResult = resetPassword($username, $secretQuestion, $secretAnswer, $newPassword);

    switch ($resetResult) {
        case 'success':
            setMessage('success', "Mot de passe réinitialisé avec succès.");
            header("Location: ../pconnexion.php");
            break;
        case 'question_mismatch':
            setMessage('error', "La question secrète ne correspond pas.");
            header("Location: ../pmdp.php");
            break;
        case 'answer_mismatch':
            setMessage('error', "La réponse à la question secrète est incorrecte.");
            header("Location: ../pmdp.php");
            break;
        default:
            setMessage('error', "Erreur lors de la réinitialisation du mot de passe.");
            header("Location: ../pmdp.php");
            break;
    }
    exit;
} else {
    header("Location: ../pmdp.php");
    exit;
}
?>