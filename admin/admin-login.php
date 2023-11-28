<?php
require("admin-requestSQL.php");
$title = "Admin-login - PhoneBook";
session_start();


if (isset($_POST['bConfirm'])) {
    $username = htmlspecialchars(strtolower(trim($_POST['username'])));
    $password = md5(trim($_POST['password']));  // Utilisation de md5 pour le mot de passe

    // Vérifier si l'utilisateur existe dans la base de données
    $userExists = checkUser($username, $password);

    if ($userExists) {
        // Si l'utilisateur existe et le mot de passe est correct
        echo '<div class="alert success" role="alert">
                <div class="mt-4 mx-8 bg-green-500 text-white font-bold rounded-t px-4 py-2">
                    Succès:
                </div>
                <div class="mx-8 border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                    Connexion réussie. Redirection en cours...
                </div>
              </div>';
              header("Location: ../paccueil.php");
              exit;
    } else {
        // Si les informations de connexion ne sont pas correctes
        $_SESSION['message'] = '<div class="mt-4 alert error" role="alert">
            <div class="mx-8 bg-red-500 text-white font-bold rounded-t px-4 py-2">
                Erreur:
            </div>
            <div class="mx-8 border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                Nom d\'utilisateur ou mot de passe incorrect.
            </div>
        </div>';
        header("Location: ../pconnexion.php");
        exit;
    }
}
?>