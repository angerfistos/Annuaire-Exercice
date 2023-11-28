<?php 
session_start();
include('./partials/header.php'); 
require('admin/admin-requestSQL.php'); // Assurez-vous que ce chemin est correct

$title = "Page d'Accueil - PhoneBook";
?>

<div class="p-8 rounded-md w-full flex-wrap">
    <div class="flex items-center justify-between pb-6 flex-wrap">
        <h2 class="mt-4 text-xl text-blue-800">Bonjour 
        <?php 
        if (!empty($_SESSION['prenom']) && !empty($_SESSION['nom'])) {
            echo $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
        } elseif (!empty($_SESSION['prenom'])) {
            echo $_SESSION['prenom'];
        } elseif (!empty($_SESSION['username'])) {
            echo $_SESSION['username'];
        } else {
            echo "Invité";
        }
        ?>, voici votre liste de contact.</h2>
        <div class="flex gap-4 block mt-4 flex-wrap">
            <a href="paddContact.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Ajouter un Contact</a>
            <button onclick="document.getElementById('fileInput').click()" class="bg-green-500 text-white font-bold py-2 px-4 rounded-full">Importer CSV</button>
            <input type="file" id="fileInput" class="hidden" accept=".csv" />
            <a href="./admin/admin-logout.php" class="bg-red-500 text-white font-bold py-2 px-4 rounded-full w-max">Se déconnecter</a>
        </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php
        if (isset($_SESSION['utilisateurID'])) {
            $contacts = getContacts($_SESSION['utilisateurID']);
            if (!empty($contacts)) {
                foreach ($contacts as $contact) {
                    echo "<div class='clic p-4 rounded-lg'>";
                    echo "<h3 class='text-xl text-gray-800 font-bold'>{$contact['nom']}, {$contact['prenom']}</h3>";
                    echo "<div class='hidden'>";
                    echo "<p>Email: {$contact['email']}</p>";
                    echo "<p>Téléphone: {$contact['telephone']}</p>";
                    echo "<p>Adresse: {$contact['adresse']}</p>";
                    echo "<p>Entreprise: {$contact['entreprise']}</p>";
                    echo "<p>Date de naissance: {$contact['dateDeNaissance']}</p>";
                    echo "<p>Note: {$contact['note']}</p>";
                    echo "<div class='flex gap-4 block mt-4 flex-wrap'>";
                    echo "<a href='peditcontact.php?contactID={$contact['contactID']}' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full'>Modifier</a>";
                    echo "<a href='admin/admin-deletecontact.php?contactID={$contact['contactID']}' class='bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full'>Supprimer</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Vous n'avez aucun contact enregistré.</p>";
            }
        } else {
            echo "<p>Veuillez vous connecter pour voir vos contacts.</p>";
        }
        ?>
    </div>
</div>

<script>
    document.querySelectorAll('.clic').forEach(card => {
        card.addEventListener('click', () => {
            let info = card.querySelector('div');
            info.classList.toggle('hidden');
        });
    });
</script>

<?php include('./partials/footer.php'); ?>