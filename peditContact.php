<?php 
include('./partials/header.php'); 
$title = "Édition de Contact - PhoneBook";
?>

<div class="mx-auto md:w-max w-full h-full mt-8">
    <div>
        <a href="index.php">
            <img class="block rounded-xl mx-auto max-w-[23rem]" src="./img/Logo.png" alt="logo Phonebook">
        </a>
    </div>
    <div class="w-full mt-8">
        <h1 class="text-center text-2xl text-[#3B5998] font-bold mb-8">Édition de Contact</h1>
        <form class="rounded pb-8">
            <!-- Nom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="nom">Nom</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="nom" type="text" placeholder="Nom">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="prenom">Prénom</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="prenom" type="text" placeholder="Prénom">
            </div>

            <!-- E-mail -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="email">E-mail</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="email" type="email" placeholder="E-mail">
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="birthdate">Date de naissance</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="birthdate" type="date">
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="adresse">Adresse</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="adresse" type="text" placeholder="Adresse">
            </div>

            <!-- Entreprise -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="entreprise">Entreprise</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="entreprise" type="text" placeholder="Entreprise">
            </div>

            <!-- Téléphone -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="telephone">Téléphone</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="telephone" type="tel" placeholder="Téléphone">
            </div>

            <!-- Note -->
            <div class="mb-6">
                <label class="block text-[#3B5998] text-sm mb-2" for="note">Note</label>
                <textarea class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="note" placeholder="Note"></textarea>
            </div>

            <!-- Boutons 'Annuler' et 'Sauvegarder' -->
            <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
                <a class="bg-gray-400 text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="index.php">Annuler</a>
                <button class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full" type="submit">Sauvegarder</button>
            </div>
        </form>
    </div>
</div>

<?php include('./partials/footer.php');?>