<?php
session_start();
require('admin-requestSQL.php');

if (isset($_POST['bEditContact'])) {
    // Récupération des données du formulaire
    $contactId = $_POST['contactId'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $entreprise = $_POST['entreprise'];
    $dateDeNaissance = $_POST['dateDeNaissance'];
    $note = $_POST['note'];

    // Vérification que les champs requis sont remplis
    if (empty($nom) || empty($prenom) || empty($telephone)) {
        setMessage('error', "Tous les champs marqués d'un * sont obligatoires.");
        header("Location: ../peditContact.php?contactId=".$contactId);
        exit;
    }

    // Mise à jour des données dans la base de données
    $result = editContact($contactId, $nom, $prenom, $email, $telephone, $adresse, $entreprise, $dateDeNaissance, $note);

    if ($result === true) {
        setMessage('success', "Contact mis à jour avec succès.");
    } else {
        setMessage('error', "Erreur lors de la mise à jour du contact : " . $result);
    }
} else {
    setMessage('error', "Aucune donnée de formulaire reçue.");
}

header("Location: ../paccueil.php");
exit;
?>