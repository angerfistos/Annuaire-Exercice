<?php 
// on recupere la connexion à la base de données
include('admin-connectdb.php');

function insertdata($nom, $prenom, $username, $password, $email, $questionSecrete, $reponseSecrete) {
    global $bdd;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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
        return '<div class="alert success mt-4 mx-8 bg-green-500 text-white font-bold rounded-t px-4 py-2">
                    Succès:
                    <div class="mx-8 px-4 py-3 text-green-700 bg-green-100">
                    Utilisateur enregistré avec succès.</div>
                </div>';
    } catch (PDOException $e) {
        return '<div class="alert error mt-4 mx-8 bg-red-500 text-white font-bold rounded-t px-4 py-2">
                    Erreur:
                </div>
                <div class="mx-8 border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    Erreur lors de l\'enregistrement : ' . htmlspecialchars($e->getMessage()) . '
                </div>';
    }
}

function checkUser($username, $password) {
    global $bdd;

    $sqlUser = "SELECT utilisateurID, nom, prenom, username, password FROM User WHERE username = :username";

    $stm = $bdd->prepare($sqlUser);
    $stm->bindParam(':username', $username, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);

    if ($result && md5($password) === $result['password']) {
        // Stocker les informations dans la session
        $_SESSION['utilisateurID'] = $result['utilisateurID'];
        $_SESSION['nom'] = $result['nom'];
        $_SESSION['prenom'] = $result['prenom'];
        $_SESSION['username'] = $result['username'];
        return true;
    }
    return false;
}

function insertContact($utilisateurID, $nom, $prenom, $telephone, $email, $adresse, $entreprise, $dateDeNaissance, $note) {
    global $bdd;

    // Préparation de la requête d'insertion
    $sqlContact = "INSERT INTO Contact (utilisateurID, nom, prenom, telephone, email, adresse, entreprise, dateDeNaissance, note) VALUES (:utilisateurID, :nom, :prenom, :telephone, :email, :adresse, :entreprise, :dateDeNaissance, :note)";
    
    $stmt = $bdd->prepare($sqlContact);

    // Liaison des paramètres
    $stmt->bindParam(':utilisateurID', $utilisateurID, PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmt->bindParam(':telephone', $telephone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $stmt->bindParam(':entreprise', $entreprise, PDO::PARAM_STR);

    // Gestion de la date de naissance
    if (!empty($dateDeNaissance)) {
        $stmt->bindParam(':dateDeNaissance', $dateDeNaissance);
    } else {
        $stmt->bindValue(':dateDeNaissance', null, PDO::PARAM_NULL);
    }

    $stmt->bindParam(':note', $note, PDO::PARAM_STR);

    // Exécution de la requête
    try {
        $stmt->execute();
        return '<div class="alert success" role="alert">
            <div class="mx-8 bg-green-500 text-white font-bold rounded-t px-4 py-2">
                Succès:
            </div>
            <div class="mx-8 border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                Contact ajouté avec succès.
            </div>
        </div>';
    } catch (PDOException $e) {
        return '<div class="alert error" role="alert">
            <div class="mx-8 bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Erreur:
            </div>
            <div class="mx-8 border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                Erreur lors de l\'ajout du contact : ' . htmlspecialchars($e->getMessage()) . '
            </div>
        </div>';
    }
}

function getContacts($utilisateurID) {
    global $bdd;

    // Requête pour sélectionner les contacts de l'utilisateur
    $sqlContact = "SELECT * FROM Contact WHERE utilisateurID = :utilisateurID";

    $stmt = $bdd->prepare($sqlContact);
    $stmt->bindParam(':utilisateurID', $utilisateurID, PDO::PARAM_INT);

    try {
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Retourner un tableau vide en cas d'erreur
        return [];
    }
}

?>