<?php 
include('admin-connectdb.php');

// Fonction les messages d'erreur ou de succès
function setMessage($type, $message) {
    $typeLabel = $type == 'error' ? 'Erreur' : 'Succès';
    $_SESSION['message'] = '<div class="alert ' . $type . ' mt-4 mx-8 font-bold px-4 py-2 rounded-t">
                                <div class="rounded mx-8 border border-t-0 rounded-b px-4 py-3 text-white" 
                                     style="background-color: ' . ($type == 'error' ? '#f56565' : '#48bb78') . ';">'
                                . $typeLabel . ': ' . $message . 
                                '</div>
                            </div>';
}

// insertion des données utilisateur dans la base de données
function insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete) {
    global $bdd;
    $hashedPassword = md5($password);

    // Vérifier si le nom d'utilisateur ou l'email existe déjà
    $sqlCheck = "SELECT username, email FROM User WHERE username = :username OR email = :email";
    $stmtCheck = $bdd->prepare($sqlCheck);
    $stmtCheck->bindParam(':username', $username);
    $stmtCheck->bindParam(':email', $email);
    $stmtCheck->execute();
    $existingUser = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        if ($existingUser['username'] === $username) {
            return 'username_exists';
        }
        if ($existingUser['email'] === $email) {
            return 'email_exists';
        }
    }
    // si l'utilisateur et l'email sont valident, insertiondes données
    $sqlUser = "INSERT INTO User (nom, prenom, username, password, email, questionSecrete, reponseSecrete) VALUES (:nom, :prenom, :username, :password, :email, :questionSecrete, :reponseSecrete)";
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
        return true;
    } catch (PDOException $e) {
        return 'db_error';
    }
}

// si utilisateur existe et si le mot de passe est correct
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

    // Préparation de la requête SQL pour mettre à jour le contact
    $sql = "UPDATE Contact SET 
                nom = :nom, 
                prenom = :prenom, 
                email = :email, 
                telephone = :telephone, 
                adresse = :adresse, 
                entreprise = :entreprise, 
                dateDeNaissance = :dateDeNaissance, 
                note = :note 
            WHERE contactId = :contactId";

    try {
        // Préparation de la requête
        $stmt = $bdd->prepare($sql);

        // Liaison des paramètres
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

        // Exécution de la requête
        $stmt->execute();

        // Si la requête s'exécute sans erreur, renvoyer vrai
        return true;
    } catch (PDOException $e) {
        // En cas d'erreur, renvoyer le message d'erreur
        return "Erreur lors de la mise à jour du contact: " . $e->getMessage();
    }
}

// fonction du mot de passe oublié
function resetPassword($username, $secretQuestion, $secretAnswer, $newPassword) {
    global $bdd;

    try {
        // Récupérer la question secrète pour l'utilisateur
        $sqlGetSecretQuestion = "SELECT questionSecrete FROM User WHERE username = :username";
        $stmtGetSecretQuestion = $bdd->prepare($sqlGetSecretQuestion);
        $stmtGetSecretQuestion->bindParam(':username', $username, PDO::PARAM_STR);
        $stmtGetSecretQuestion->execute();
        $userQuestion = $stmtGetSecretQuestion->fetch(PDO::FETCH_ASSOC);

        if (!$userQuestion || $secretQuestion !== $userQuestion['questionSecrete']) {
            return 'question_mismatch';
        }

        // Vérifier la réponse secrète
        $sql = "SELECT * FROM User WHERE username = :username AND reponseSecrete = :reponseSecrete";
        $stmt = $bdd->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':reponseSecrete', $secretAnswer, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $hashedPassword = md5($newPassword); // Utilisation de MD5 pour le hachage du mot de passe
            $updateSql = "UPDATE User SET password = :password WHERE username = :username";
            $updateStmt = $bdd->prepare($updateSql);
            $updateStmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $updateStmt->bindParam(':username', $username, PDO::PARAM_STR);
            $updateStmt->execute();

            return 'success';
        } else {
            return 'answer_mismatch';
        }
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête SQL
        error_log("Erreur lors de la réinitialisation du mot de passe : " . $e->getMessage());
        return 'error';
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

    // Vérifie si le fichier existe et est lisible
    if (!file_exists($filePath) || !is_readable($filePath)) {
        setMessage('error', "Le fichier CSV spécifié est introuvable ou illisible.");
        return false;
    }

    $importSuccess = true;
    $bdd->beginTransaction();

    if (($handle = fopen($filePath, "r")) !== FALSE) {
        fgetcsv($handle, 1000, ";"); // Ignorer les en-têtes

        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
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

            // Préparation de la requête SQL
            $sql = "INSERT INTO Contact (utilisateurID, nom, prenom, telephone, email, adresse, entreprise, dateDeNaissance, note) VALUES (:utilisateurID, :nom, :prenom, :telephone, :email, :adresse, :entreprise, :dateDeNaissance, :note)";
            $stmt = $bdd->prepare($sql);

            // Bind des paramètres
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
                setMessage('error', "Erreur lors de l'importation du CSV : " . $e->getMessage());
                $importSuccess = false;
                $bdd->rollback();
                break;
            }
        }
        fclose($handle);
    } else {
        $importSuccess = false;
        setMessage('error', "Erreur lors de l'ouverture du fichier CSV.");
    }

    if ($importSuccess) {
        $bdd->commit();
        setMessage('success', "Importation CSV réussie.");
    }

    return $importSuccess;
}
?>