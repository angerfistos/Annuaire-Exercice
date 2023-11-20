<?php
 require ('./partials/header.php');
?>

<div class="md:flex container mx-auto">
    <div>
        <img class="block mx-auto rounded-xl" src="./img/Logo.png" alt="logo Phonebook">
    </div>
    <div class="w-full w-fit mx-auto md:flex md:flex-col md:justify-center">
        <h1 class="mt-4 text-center text-2xl font-bold text-[#3B5998]">Connexion</h1>
        <form class="rounded px-4 pb-8 m-4">
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm font-bold mb-2" for="username">
                    Nom d'utilisateur
                </label>
                <input class="bg-white shadow appearance-none border border-black rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline rounded-full" id="username" type="text" placeholder="Nom d'utilisateur">
            </div>
            <div class="mb-6">
                <label class="block text-[#3B5998] text-sm font-bold mb-2" for="password">
                    Mot de passe
                </label>
                <input class="bg-white rounded-full shadow appearance-none border-black border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight" id="password" type="password" placeholder="******************">
            </div>
            <button class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full w-full" type="button">
            Confirmer
            </button>
            <div class="flex mt-8 justify-between">
                <!-- Créer un compte? redirige vers la page pinscription.php -->
                <a class="block font-bold" href="pinscription.php">Créer un compte?</a>
                <!-- mot de passe oublié? redirige vers la page pmdp.php -->
                <a class="block font-bold" href="pmdp.php">mot de passe oublié?</a>
            </div>
        </form>
    </div>
</div>

<?php
require ('./partials/footer.php');
?>