<?php
session_start();
require('admin-requestSQL.php');

if (isset($_GET['contactId'])) {
    $contactId = $_GET['contactId'];

    // Suppression du contact
    $result = deleteContactById($contactId);

    // Gestion des messages
    if ($result) {
        setMessage('success', "Contact supprimé avec succès.");
    } else {
        setMessage('error', "Erreur lors de la suppression du contact.");
    }
} else {
    setMessage('error', "Aucun identifiant de contact spécifié.");
}

header("Location: ../paccueil.php");
exit;
?>