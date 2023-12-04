<?php 
session_start();
include('admin/admin-requestSQL.php'); // Assurez-vous que le chemin est correct

// Vérifier si l'ID du contact est passé dans l'URL
if (isset($_GET['contactId'])) {
    $contactId = $_GET['contactId'];
    $contact = getContactById($contactId);
} else {
    // Rediriger si aucun ID n'est fourni
    header("Location: paccueil.php");
    exit;
}

$title = "Édition de Contact - PhoneBook";
include('./partials/header.php'); 
?>

<div class="mx-auto md:w-max w-full h-full mt-8">
    <div class="w-full mt-8">
        <h1 class="text-center text-2xl text-[#3B5998] font-bold mb-8">Édition de Contact</h1>
        <form class="rounded pb-8" action="admin/admin-editContact.php" method="post">
            <input type="hidden" name="contactId" value="<?php echo $contact['contactId']; ?>">

            <!-- Nom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="nom">Nom</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nom" name="nom" type="text" placeholder="Nom" value="<?php echo $contact['nom']; ?>">
            </div>

            <!-- Prénom -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="prenom">Prénom</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="prenom" name="prenom" type="text" placeholder="Prénom" value="<?php echo $contact['prenom']; ?>">
            </div>

            <!-- E-mail -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="email">E-mail</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="E-mail" value="<?php echo $contact['email']; ?>">
            </div>

            <!-- Date de naissance -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="dateDeNaissance">Date de naissance</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="dateDeNaissance" name="dateDeNaissance" type="date" value="<?php echo $contact['dateDeNaissance']; ?>">
            </div>

            <!-- Adresse -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="adresse">Adresse</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="adresse" name="adresse" type="text" placeholder="Adresse" value="<?php echo $contact['adresse']; ?>">
            </div>

            <!-- Entreprise -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="entreprise">Entreprise</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="entreprise" name="entreprise" type="text" placeholder="Entreprise" value="<?php echo $contact['entreprise']; ?>">
            </div>

            <!-- Téléphone -->

            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="telephone">Téléphone</label>
                <input class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="telephone" name="telephone" type="tel" placeholder="Téléphone" value="<?php echo $contact['telephone']; ?>">
            </div>

            <!-- Note -->
            <div class="mb-4">
                <label class="block text-[#3B5998] text-sm mb-2" for="note">Note</label>
                <textarea class="bg-white shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="note" name="note" placeholder="Note"><?php echo $contact['note']; ?></textarea>
            </div>

            <!-- Boutons 'Annuler' et 'Sauvegarder' -->
            <div class="flex flex-wrap justify-between gap-4 mx-auto mt-4">
                <a class="bg-gray-400 text-white text-sm md:text-base font-bold py-2 px-4 rounded-full block" href="paccueil.php">Annuler</a>
                <button name="bEditContact" class="bg-[#3B5998] text-white font-bold py-2 px-4 rounded-full" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<?php include('./partials/footer.php'); ?>
