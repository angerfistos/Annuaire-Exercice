<?php 
// Définition des variables de connexion
$host = "localhost:8889"; // Ou 3307 si vous changez le port, par exemple
$dbname = "annuaire";
$username = "root";
$passwordbdd = "root";
$dsn = "mysql:host=" . $host . ";dbname=" . $dbname;

// Initialisation de la connexion
try {
    $bdd = new PDO($dsn, $username, $passwordbdd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie";
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>