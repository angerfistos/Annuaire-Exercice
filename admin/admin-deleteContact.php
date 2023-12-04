<?php
include('admin-requestSQL.php'); 

if (isset($_GET['contactID'])) {
    $contactId = $_GET['contactID'];
    $contact = getContactById($contactId);
    
    if ($contact) {
        $result = deleteContactById($contactId);
        if ($result) {
            header('Location: ../paccueil.php?status=success&message=Contact+Deleted');
            exit;
        } else {
            header('Location: ../paccueil.php?status=error&message=Unable+to+Delete+Contact');
            exit;
        }
    } else {
        echo "Aucun contact sélectionné pour la suppression.";
    }
} else {
    echo "Aucun contact sélectionné pour la suppression.";
}
?>