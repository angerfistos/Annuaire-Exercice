<?php 
include('./partials/header.php'); 
$title = "Inscription - PhoneBook";
session_start();

// Affichage des messages (erreur ou succès)
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);

    // Script pour masquer automatiquement l'alerte après 5 secondes
    echo "<script>
        setTimeout(function() {
            document.querySelector('.alert').style.display = 'none';
        }, 5000);
    </script>";
}
?>

<div class="mx-auto md:w-max w-full h-full mt-8">
    <form class="rounded pb-8" action="admin/admin-inscription.php" method="post">
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
            <!-- Nom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="nom">Nom</label>
                <input autofocus class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="nom" id="nom" type="text" placeholder="Nom" value="<?php echo isset($_SESSION['formData']['nom']) ? htmlspecialchars($_SESSION['formData']['nom']) : ''; ?>">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="prenom">Prénom</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="prenom" type="text" placeholder="Prénom" value="<?php echo isset($_SESSION['formData']['prenom']) ? htmlspecialchars($_SESSION['formData']['prenom']) : ''; ?>">
            </div>

            <!-- Nom d'utilisateur -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="username">Nom d'utilisateur<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="username" type="text" placeholder="Nom d'utilisateur" value="<?php echo isset($_SESSION['formData']['username']) ? htmlspecialchars($_SESSION['formData']['username']) : ''; ?>">
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="birthdate">Date de naissance</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="dateDeNaissance" id="dateDeNaissance" type="date" value="<?php echo isset($_SESSION['formData']['dateDeNaissance']) ? $_SESSION['formData']['dateDeNaissance'] : ''; ?>">
            </div>
            
            <!-- E-mail -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="email">E-mail<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="email1" id="email" type="email" placeholder="E-mail" value="<?php echo isset($_SESSION['formData']['email']) ? htmlspecialchars($_SESSION['formData']['email']) : ''; ?>">
            </div>

            <!-- Confirmez votre e-mail -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="confirm-email">Confirmez votre e-mail<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="email2" id="confirm-email" type="email" placeholder="Confirmez votre e-mail">
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="password">Mot de passe<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="password1" id="password" type="password" placeholder="Mot de passe">
            </div>

            <!-- Confirmez votre mot de passe -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="confirm-password">Confirmez votre mot de passe<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="password2" id="confirm-password" type="password" placeholder="Confirmez votre mot de passe">
            </div>

            <!-- Question secrète -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="secret-question">Question secrète<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="questionSecrete" id="secret-question" type="text" placeholder="Question secrète" value="<?php echo isset($_SESSION['formData']['questionSecrete']) ? htmlspecialchars($_SESSION['formData']['questionSecrete']) : ''; ?>">
            </div>

            <!-- Réponse -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="secret-answer">Réponse<span class="text-red-500">*</span></label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="secret-answer" name="reponseSecrete" type="text" placeholder="Réponse">
            </div>
        </div>

        <!-- Boutons 'Annuler' et 'Confirmer' -->
        <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
            <a class="bg-gray-400 text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="index.php">Annuler</a>
            <button class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full" type="submit" name="bInscription">Confirmer</button>
        </div>
    </form>
</div>

<?php 
// si valide, on supprime la session formData
if (isset($_SESSION['formData'])) {
    unset($_SESSION['formData']);
}
include('./partials/footer.php');
?>