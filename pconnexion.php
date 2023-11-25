<?php 
include('./partials/header.php'); 
$title = "Page de connexion - PhoneBook";
?>

<div class="mx-auto md:w-max w-full h-full mt-8">
    <div>
        <a href="index.php">
            <img class="block rounded-xl mx-auto max-w-[23rem]" src="./img/Logo.png" alt="logo Phonebook">
        </a>
    </div>
    <div class="w-full mt-8">
        <h1 class="text-center text-2xl text-[#3B5998] font-bold mb-8">Connexion</h1>
        <!-- formulaire de connexion -->
        <form class="rounded pb-8">
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="username">Nom d'utilisateur</label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="username" type="text" placeholder="Nom d'utilisateur">
            </div>
            <div class="mb-6">
                <label class="block text-[#3B5998] text-sm mb-2" for="password">Mot de passe</label>
                <input class="bg-white rounded-full shadow appearance-none border-black border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight" id="password" type="password" placeholder="******************">
            </div>
            <a href="paccueil.php" class="mx-auto block bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full w-max" type="button">Confirmer</a>
        </form>
        <!-- bouton pour créer un compte et mot de passe oublié -->
        <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
            <a class="bg-[#3B5998] text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="pinscription.php">Créer un compte</a>
            <a class="bg-[#3B5998] text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="pmdp.php">mot de passe oublié</a>
        </div>
    </div>
</div>

<?php include('./partials/footer.php');?>