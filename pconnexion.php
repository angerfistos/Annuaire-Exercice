<?php 
$title = "Page de connexion - PhoneBook";
include('./partials/header.php'); 
?>

<div class="container">
    <div class="md:flex items-center">
        <div class="mx-auto">
            <img class="block rounded-xl w-full" src="./img/Logo.png" alt="logo Phonebook">
        </div>
        <div class="w-1/2 mx-auto">
            <h1 class="mt-4 text-center text-2xl font-bold text-[#3B5998]">Connexion</h1>
            <form class="rounded pb-8">
            <div class="mb-4">
                    <label class="block text-[#3B5998] text-sm mb-2" for="username">
                        Nom d'utilisateur
                    </label>
                    <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="username" type="text" placeholder="Nom d'utilisateur">
                </div>
                <div class="mb-6">
                    <label class="block text-[#3B5998] text-sm mb-2" for="password">
                        Mot de passe
                    </label>
                    <input class="bg-white rounded-full shadow appearance-none border-black border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight" id="password" type="password" placeholder="******************">
                </div>
                <button class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full w-full" type="button">
                Confirmer
                </button>
                <div class="md:flex md:mt-8 md:justify-between">
                    <!-- Créer un compte? redirige vers la page pinscription.php -->
                    <a class="text-[#3B5998] block mt-4" href="pinscription.php">Créer un compte?</a>
                    <!-- mot de passe oublié? redirige vers la page pmdp.php -->
                    <a class="text-[#3B5998] block mt-4" href="pmdp.php">mot de passe oublié?</a>
                </div>
            </form>
        </div>
    </div>
    <?php include('./partials/footer.php');?>
</div>
