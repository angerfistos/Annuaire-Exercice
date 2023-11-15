<?php 
// on recupere la connexion à la base de données
include('admin-connectdb.php');

function insertdata($nom, $prenom, $dateDeNaissance, $fonction, $user, $password) {

    // on recupère notre variable globale
    global $bdd;

    // insertion de l'utilisateur dans la base de données
    $sqlUser = "INSERT INTO users (username, password) VALUES (:user, :password)";
    // on prépare la requête
    $stmUser = $bdd->prepare($sqlUser); // $stmUser = statementUser = requête préparée pour l'utilisateur
    // on binde les paramètres
    $stmUser->bindParam(':user', $user, PDO::PARAM_STR);
    $stmUser->bindParam(':password', $password, PDO::PARAM_STR);
    // on exécute la requête
    try {
        $stmUser->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        $message = "Une erreur s'est produite";
    }
    $sqlLasterUser = "SELECT id FROM users where username = :user limit 1";
    $stmLasterUser = $bdd->prepare($sqlLasterUser);
    $stmLasterUser->bindParam(':user', $user, PDO::PARAM_STR);
    $stmLasterUser->execute();
    // on récupère l'ensemble des données de l'utilisateur inséré
    $id = $stmLasterUser->fetchColumn();
    // Formatage de la date en format SQL
    $dateDeNaissance = date('Y-m-d', strtotime($dateDeNaissance));

    // insertion des données dans la table userdata
    $sqlUserData = "INSERT INTO userdata (nom, prenom, dateDeNaissance, fonction, users) VALUES (:nom, :prenom, :dateDeNaissance, :fonction, :users)";
    $stmUserData = $bdd->prepare($sqlUserData);
    $stmUserData->bindParam(':nom', $nom, PDO::PARAM_STR);
    $stmUserData->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $stmUserData->bindParam(':dateDeNaissance', $dateDeNaissance, PDO::PARAM_STR);
    $stmUserData->bindParam(':fonction', $fonction, PDO::PARAM_STR);
    $stmUserData->bindParam(':users', $id, PDO::PARAM_INT);
    try {
        $stmUserData->execute();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        $message = "Une erreur s'est produite";
    }
    $message = "L'utilisateur a bien été ajouté";
    return $message;
}

function checkUser($user, $password) {
    global $bdd;
    
    $sqlUser = "SELECT u.id, u.username, u.password, ud.nom, ud.prenom 
                FROM users u 
                JOIN userdata ud  
                WHERE u.username = :user AND u.password = :password AND u.id = ud.users";

    $stm = $bdd->prepare($sqlUser);
    $stm->bindParam(':user', $user, PDO::PARAM_STR);
    $stm->bindParam(':password', $password, PDO::PARAM_STR);
    $stm->execute();
    $result = $stm->fetch(PDO::FETCH_ASSOC);
    //var_dump($result);exit;
    // Si l'utilisateur existe, on retourne ses données

    if ($result) {
        //var_dump($result,"test");exit;
        $hashedPassword = $result['password'];

        if ($password === $hashedPassword) { // Si le mot de passe est correct
            $nom = $result['nom']; // On récupère le nom et le prénom de l'utilisateur
            $prenom = $result['prenom']; 
            //var_dump($nom, $prenom);exit; // On retourne un tableau avec le nom et le prénom
            $_SESSION['data'] = null;
            $_SESSION['data'] = ['nom' => $result['nom'], 'prenom' => $result['prenom']];
            //var_dump($_SESSION['data'], $result);exit;
            //var_dump($result);exit;
            return true;
        }
    }
    return false; // L'utilisateur n'existe pas
}

function getAllUsers() {
    global $bdd; // Utilisez la variable de connexion globale

    $sql = "SELECT nom, prenom, fonction, dateDeNaissance FROM userdata";
    $stmt = $bdd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les utilisateurs sous forme de tableau associatif
}

// Fonction pour récupérer les détails d'un utilisateur par son ID
function getUserById($id) {
    global $bdd;
    $sql = "SELECT * FROM userdata WHERE id = :id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fonction pour supprimer un utilisateur par son ID
function deleteUserById($id) {
    global $bdd;
    $sql = "DELETE FROM users WHERE id = :id"; // Assurez-vous que cette commande SQL correspond à votre structure de base de données
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}
?>