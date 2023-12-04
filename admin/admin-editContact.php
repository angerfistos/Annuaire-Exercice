<?php
session_start();
require('admin-requestSQL.php'); 

// Vérifier si le formulaire a été soumis
if (isset($_POST['bEditContact'])) {
    $contactId = $_POST['contactId'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $entreprise = $_POST['entreprise'];
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $note = $_POST['note'];

    // Mise à jour des données dans la base de données
    $result = editContact($contactId, $nom, $prenom, $email, $telephone, $adresse, $entreprise, $dateDeNaissance, $note);

    if ($result === true) {
        $_SESSION['message'] = "Contact mis à jour avec succès.";
    } else {
        // $result contient le message d'erreur retourné par la fonction editContact
        $_SESSION['message'] = "Erreur lors de la mise à jour du contact : " . $result;
    }
} else {
    $_SESSION['message'] = "Aucune donnée de formulaire reçue.";
}

header("Location: ../paccueil.php");
exit;
?>