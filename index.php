<?php 
session_start();
include ('./admin/admin-requestSQL.php');
include('./partials/header.php'); 
$title = "PhoneBook";

if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);

    echo "<script>
            setTimeout(function() {
                document.querySelector('.alert').style.display = 'none';
            }, 5000);
        </script>";
}
?>

 
<div class="mx-auto md:w-max w-full h-full mt-8"> 
    <div>
        <a href="index.php">
            <img class="block rounded-xl mx-auto max-w-[23rem]" src="./img/Logo.png" alt="logo Phonebook">
        </a>
    </div>
    <div class="w-full mt-8">
        <h1 class="text-center text-2xl text-[#3B5998] font-bold mb-8">Bienvenue sur PhoneBook</h1>
        <div class="text-[#3B5998] mt-4"> 
            <p>PhoneBook est la solution pour la gestion de vos contacts.</p><br>
            <p>Avec PhoneBook, gérez, accédez et sauvegardez vos contacts en toute simplicité.</p>
        </div>
        <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
        <!-- bouton pour se connecter et créer un compte -->
        <a class="bg-[#3B5998] text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="pconnexion.php">Se connecter</a>
            <a class="bg-[#3B5998] text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="pinscription.php">Créer un compte</a>
        </div>
    </div>
</div>

<?php include('./partials/footer.php');?>