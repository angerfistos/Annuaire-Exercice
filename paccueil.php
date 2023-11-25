<?php 
include('./partials/header.php'); 
$title = "Page d'Accueil - PhoneBook";
?>

<div class="mx-auto w-full h-full mt-8">
    <div class="flex gap-4 mb-4">
        <div class="mx-auto flex gap-8 flex-wrap">
            <a href="padd.php" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-full">Ajouter un Contact</a>
            <button onclick="document.getElementById('fileInput').click()" class="bg-green-500 text-white font-bold py-2 px-4 rounded-full">Importer CSV</button>
            <input type="file" id="fileInput" class="hidden" accept=".csv" />
            <a href="./admin/admin-logout.php" class="bg-red-500 text-white font-bold py-2 px-4 rounded-full w-max">Se déconnecter</a>
        </div>
    </div>

    <!-- Tableau des contacts -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-xl text-left">Nom</th>
                    <th class="py-3 px-6 text-xl text-left">Prénom</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <!-- Premier contact -->
                <tr class="border-2 border-black">
                    <td class="py-3 px-6 text-xl text-left text-[#3B5998] font-bold">Doe</td>
                    <td class="py-3 px-6 text-xl text-left text-[#3B5998] font-bold">John</td>
                </tr>
                <tr class="hidden border-2 border-black">
                    <td colspan="2">
                        <div class="p-4 mb-2 text-[#647AA9] text-xl">
                            <span class="font-bold">Email:</span> john.doe@example.com<br>
                            <span class="font-bold">Téléphone:</span><br>
                            <span class="font-bold">Adresse:</span> 123 Main St, City, Country<br>
                            <span class="font-bold">Entreprise:</span>Example Inc<br>
                            <span class="font-bold">Note:</span> A friendly contact<br>
                            <div class="flex justify-end mt-2">
                                <a href="pedit.php" class="text-blue-500 mr-2">Modifier</a>
                                <button class="text-red-500">Supprimer</button>
                            </div>
                        </div>
                    </td>
                </tr>

                <!-- Deuxième contact -->
                <tr class="border-2 border-black">
                    <td class="py-3 px-6 text-xl text-left text-[#3B5998] font-bold">Doe</td>
                    <td class="py-3 px-6 text-xl text-left text-[#3B5998] font-bold">John</td>
                </tr>
                <tr class="hidden border-2 border-black">
                    <td colspan="2">
                        <div class="p-4 mb-2 text-[#647AA9] text-xl">
                            <span class="font-bold">Email:</span> john.doe@example.com<br>
                            <span class="font-bold">Téléphone:</span><br>
                            <span class="font-bold">Adresse:</span> 123 Main St, City, Country<br>
                            <span class="font-bold">Entreprise:</span>Example Inc<br>
                            <span class="font-bold">Note:</span> A friendly contact<br>
                            <div class="flex justify-end mt-2">
                                <a href="pedit.php" class="text-blue-500 mr-2">Modifier</a>
                                <button class="text-red-500">Supprimer</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        // JavaScript pour gérer l'affichage du sous-tableau
        document.querySelectorAll('.table-auto tbody tr').forEach((row, index) => {
            if (index % 2 === 0) {
                row.addEventListener('click', () => {
                    let nextRow = row.nextElementSibling;
                    if (nextRow) {
                        nextRow.classList.toggle('hidden');
                    }
                });
            }
        });
    </script>
</div>

<?php include('./partials/footer.php');?>
