<?php 
include('./partials/header.php'); 
$title = "Inscription - PhoneBook";
session_start();

// Affichage des erreurs
if (isset($_SESSION['errors'])) {
    echo $_SESSION['errors'];
    unset($_SESSION['errors']);
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
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="nom" id="nom" type="text" placeholder="Nom">
                        </div>

                        <!-- Prénom -->
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="prenom">Prénom</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="prenom" type="text" placeholder="Prénom">
                        </div>
                    </div>

                    <!-- Nom d'utilisateur -->
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="username">Nom d'utilisateur</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="username" type="text" placeholder="Nom d'utilisateur">
                        </div>
                        
                        <!-- Date de naissance -->
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="birthdate">Date de naissance</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="dateDeNaissance" id="dateDeNaissance" type="date">
                        </div>
                    </div>

                    <!-- E-mail et Confirmez votre e-mail -->
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="email">E-mail</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="email1" id="email" type="email" placeholder="E-mail">
                        </div>

                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="confirm-email">Confirmez votre e-mail</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full"
                            name="email2" id="confirm-email" type="email" placeholder="Confirmez votre e-mail">
                        </div>
                    </div>

                    <!-- Mot de passe et Confirmez votre mot de passe -->
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="password">Mot de passe</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="password1" id="password" type="password" placeholder="Mot de passe">
                        </div>
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="confirm-password">Confirmez votre mot de passe</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full"
                            name="password2" id="confirm-password" type="password" placeholder="Confirmez votre mot de passe">
                        </div>
                    </div>

                    <!-- Question secrète et Réponse -->
                    <div class="grid grid-cols-1 md:grid-cols-2 md:gap-4">
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="secret-question">Question secrète</label>
                            <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" name="questionSecrete" id="secret-question" type="text" placeholder="Question secrète">
                        </div>
                        <div class="mb-4">
                            <label class="block text-[#3B5998] text-sm mb-2" for="secret-answer">Réponse</label>
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

<?php include('./partials/footer.php');?>