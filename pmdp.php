<?php 
include('./partials/header.php'); 
$title = "Réinitialisation du mot de passe - PhoneBook";
?>

<div class="mx-auto md:w-max w-full h-full mt-8">
    <div>
        <a href="index.php">
            <img class="block rounded-xl mx-auto max-w-[23rem]" src="./img/Logo.png" alt="logo Phonebook">
        </a>
    </div>
    <div class="w-full mt-8">
        <h1 class="text-center text-2xl text-[#3B5998] font-bold mb-8">Réinitialisation du mot de passe</h1>
        <form class="rounded pb-8">
            <!-- Champ Nom d'utilisateur -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="username">Nom d'utilisateur</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="username" type="text" placeholder="Nom d'utilisateur">
            </div>

            <!-- Champ Question secrète -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="secret-question">Question secrète</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="secret-question" type="text" placeholder="Question secrète">
            </div>

            <!-- Champ Réponse -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="secret-answer">Réponse</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="secret-answer" type="text" placeholder="Réponse">
            </div>

            <!-- Champ Nouveau mot de passe -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="new-password">Nouveau mot de passe</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="new-password" type="password" placeholder="Nouveau mot de passe">
            </div>

            <!-- Champ Confirmez votre mot de passe -->
            <div class="mb-6">
                <label class="block text-[#3B5998] text-sm mb-2" for="confirm-password">Confirmez votre mot de passe</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="confirm-password" type="password" placeholder="Confirmez votre mot de passe">
            </div>

            <!-- Boutons 'Annuler' et 'Confirmer' -->
            <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
                <a class="bg-gray-400 text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="index.php">Annuler</a>
                <a href="pconnexion.php" class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full" type="submit">Confirmer</a>
            </div>
        </form>
    </div>
</div>

<?php include('./partials/footer.php');?>