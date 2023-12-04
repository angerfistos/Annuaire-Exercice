<?php 
include('admin-connectdb.php');

// fonction pour l'insertion des utilisateurs dans la base de données (inscription)
function insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete) {
    global $bdd;
    $hashedPassword = md5($password);

    $sqlUser = "INSERT INTO User (nom, prenom, username, password, email, questionSecrete, reponseSecrete) 
                VALUES (:nom, :prenom, :username, :password, :email, :questionSecrete, :reponseSecrete)";
    $stmUser = $bdd->prepare($sqlUser);

    $stmUser->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmUser->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmUser->bindParam(':username', $username, PDO::PARAM_STR);
    $stmUser->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmUser->bindParam(':email', $email, PDO::PARAM_STR);
    $stmUser->bindParam(':questionSecrete', $questionSecrete, PDO::PARAM_STR);
    $stmUser->bindParam(':reponseSecrete', $reponseSecrete, PDO::PARAM_STR);

    try {
        $stmUser->execute();
        return ['status' => 'success', 'message' => 'Utilisateur enregistré avec succès.'];
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            return '<div class="alert error mt-4 mx-8 bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Erreur:
                        <div class="mx-8 border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        Ce nom d\'utilisateur est déjà utilisé.</div>
                    </div>';
        } else {
            return '<div class="alert error mt-4 mx-8 bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Erreur:
                        <div class="mx-8 border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">' . 
                        htmlspecialchars($e->getMessage()) . '</div>
                    </div>';
        }
    }
}

// Vérifie si l'utilisateur existe et si le mot de passe est correct
function checkUser($username, $password) {
    global $bdd;

    $sqlUser = "SELECT utilisateurID, nom, prenom, username, password FROM User WHERE username = :username";
    $stm = $bdd->prepare($sqlUser);
    $stm->bindParam(':username', $username, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    if ($result && $password === $result['password']) {
        $_SESSION['utilisateurID'] = $result['utilisateurID'];
        $_SESSION['nom'] = $result['nom'];
        $_SESSION['prenom'] = $result['prenom'];
        $_SESSION['username'] = $result['username'];
        return true;
    }
    return false;
}

// fonction ajout de contact dans la base de données
function insertContact($utilisateurID, $nom, $prenom, $telephone, $email, $adresse, $entreprise, $dateDeNaissance, $note) {
    global $bdd;

    $sqlContact = "INSERT INTO Contact (utilisateurID, nom, prenom, telephone, email, adresse, entreprise, dateDeNaissance, note) VALUES (:utilisateurID, :nom, :prenom, :telephone, :email, :adresse, :entreprise, :dateDeNaissance, :note)";
    
    $stmt = $bdd->prepare($sqlContact);

    $stmt->bindParam(':utilisateurID', $utilisateurID, PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $stmt->bindParam(':entreprise', $entreprise, PDO::PARAM_STR);

    // Gestion de la date de naissance nulle
    if (!empty($dateDeNaissance)) {
        $stmt->bindParam(':dateDeNaissance', $dateDeNaissance);
    } else {
        $stmt->bindValue(':dateDeNaissance', null, PDO::PARAM_NULL);
    }

    $stmt->bindParam(':note', $note, PDO::PARAM_STR);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du contact : " . $e->getMessage());
        return false; 
}
}

// selection de tout les contacts
function getContacts($utilisateurID) {
    global $bdd;

    $sqlContact = "SELECT contactId, utilisateurID, nom, prenom, telephone, email, adresse, entreprise, dateDeNaissance, note FROM Contact WHERE utilisateurID = :utilisateurID";

    $stmt = $bdd->prepare($sqlContact);
    $stmt->bindParam(':utilisateurID', $utilisateurID, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Erreur lors de la récupération des contacts : " . $e->getMessage();
    }
}

// selection du contact par son ID
function getContactById($contactId) {
    global $bdd;

    $sql = "SELECT * FROM Contact WHERE contactId = :contactId";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':contactId', $contactId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return false;
    }
}

// suppression du contact par son ID
function deleteContactById($contactId) {
    global $bdd;

    $sql = "DELETE FROM Contact WHERE contactId = :contactId";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':contactId', $contactId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

// modification du contact par son ID
function editContact($contactId, $nom, $prenom, $email, $telephone, $adresse, $entreprise, $dateDeNaissance, $note) {
    global $bdd;

    $sql = "UPDATE Contact SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, adresse = :adresse, entreprise = :entreprise, dateDeNaissance = :dateDeNaissance, note = :note WHERE contactId = :contactId";

    try {
        $stmt = $bdd->prepare($sql);

        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
        $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $stmt->bindParam(':entreprise', $entreprise, PDO::PARAM_STR);

        // Gestion de la date de naissance nulle
        if (!empty($dateDeNaissance)) {
            $stmt->bindParam(':dateDeNaissance', $dateDeNaissance);
        } else {
            $stmt->bindValue(':dateDeNaissance', null, PDO::PARAM_NULL);
        }

        $stmt->bindParam(':note', $note, PDO::PARAM_STR);
        $stmt->bindParam(':contactId', $contactId, PDO::PARAM_INT);

        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        return "Erreur lors de la mise à jour du contact. Veuillez réessayer.";
    }
}

// fonction du mot de passe oublié
function resetPassword($username, $secretQuestion, $secretAnswer, $newPassword) {
    global $bdd;

    try {
        // Vérifier d'abord la question secrète et la réponse
        $sql = "SELECT * FROM User WHERE username = :username AND questionSecrete = :questionSecrete AND reponseSecrete = :reponseSecrete";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':questionSecrete', $secretQuestion, PDO::PARAM_STR);
        $stmt->bindParam(':reponseSecrete', $secretAnswer, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            // Mise à jour du mot de passe
            $hashedPassword = md5($newPassword);
            $updateSql = "UPDATE User SET password = :password WHERE username = :username";
            $updateStmt = $bdd->prepare($updateSql);
            $updateStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $updateStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $updateStmt->execute();

            return true;
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        return false;
    }
}

// nettoyage des données pour le fichier CSV
function cleanData($data) {
    // Si la donnée est null, retourne une chaîne vide
    if ($data === null || $data === 'null') {
        return '';
    }
    return trim(htmlspecialchars($data));
}

// validation de la date si elle est au format Y-m-d
function isValidDate($date, $format = 'Y-m-d') {
    // Vérifie si la date est nulle ou le mot 'NULL'
    if ($date === null || strtolower($date) === 'null') {
        return true; // Considère les valeurs NULL comme valides
    }

    // Vérifie si la date correspond au format spécifié
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function importCSVToDatabase($filePath, $utilisateurID) {
    global $bdd;

    // Vérification de l'existence et de la lisibilité du fichier
    if (!file_exists($filePath) || !is_readable($filePath)) {
        error_log("Le fichier CSV spécifié est introuvable ou illisible.");
        return false;
    }

    $importSuccess = true;

    // Début de la transaction
    $bdd->beginTransaction();

    if (($handle = fopen($filePath, "r")) !== FALSE) {
        // Lire la première ligne pour ignorer les en-têtes
        fgetcsv($handle, 1000, ";");

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            // Nettoyage et assignation des données
            $nom = cleanData($data[2]);
            $prenom = cleanData($data[3]);
            $telephone = cleanData($data[4]);
            $email = cleanData($data[5]);
            $adresse = cleanData($data[6]);
            $entreprise = cleanData($data[7]);
            $dateDeNaissance = cleanData($data[8]);
            $note = isset($data[7]) ? cleanData($data[9]) : null;

            // Traitement des valeurs 'NULL'
            $entreprise = ($entreprise === '' || strtolower($entreprise) === 'null') ? null : $entreprise;
            $dateDeNaissance = ($dateDeNaissance === '' || strtolower($dateDeNaissance) === 'null' || !isValidDate($dateDeNaissance)) ? null : $dateDeNaissance;
            $note = ($note === '' || strtolower($note) === 'null') ? null : $note;

            // Préparation de la requête SQL
            $sql = "INSERT INTO Contact (utilisateurID, nom, prenom, telephone, email, adresse, entreprise, dateDeNaissance, note) VALUES (:utilisateurID, :nom, :prenom, :telephone, :email, :adresse, :entreprise, :dateDeNaissance, :note)";
            $stmt = $bdd->prepare($sql);

            $stmt->bindParam(':utilisateurID', $utilisateurID, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
            $stmt->bindParam(':entreprise', $entreprise, PDO::PARAM_STR);
            $stmt->bindParam(':dateDeNaissance', $dateDeNaissance, PDO::PARAM_STR);
            $stmt->bindParam(':note', $note, PDO::PARAM_STR);

            try {
                $stmt->execute();
            } catch (PDOException $e) {
                error_log("Erreur d'import CSV: " . $e->getMessage());
                $importSuccess = false;
                $bdd->rollback();
                break;
            }
        }
        fclose($handle);
    } else {
        $importSuccess = false;
    }

    if ($importSuccess) {
        $bdd->commit();
    }

    return $importSuccess;
}
?>



