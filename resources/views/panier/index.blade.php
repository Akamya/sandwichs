<x-app-layout>
    <script>
    const userID = @json($userID);
    const panierUserID = `panier-${userID}`;
    function viderPanier(){
        localStorage.removeItem(panierUserID);
        location.reload();
    }
    document.addEventListener("DOMContentLoaded", () => {
        const panierElement = document.querySelector("#panier tbody");
        const panierTotalElement = document.querySelector("#panierTotal");

        const products = {!! json_encode($products) !!}; // Encode les produits en JSON

            // console.log(products);
        // Récupère les données du localStorage
        const savedPanier = JSON.parse(localStorage.getItem(panierUserID)) || [];

        console.log(savedPanier); // Vérifie les données dans la console

        let total = 0;


        // Fonction pour afficher le panier
        function displayPanier() {
            panierElement.innerHTML = ""; // Vide le tableau avant d'ajouter des lignes
            if (savedPanier.length === 0) {

                panierElement.innerHTML = "<tr><td colspan='7' class='text-center'>Le panier est vide</td></tr>";
            } else {
                savedPanier.forEach((elementPanier) => {
                    const product = products.find(element=> element.id === elementPanier.productId);
                    let prix = product.prix;
                    if(elementPanier.size === 'normal'){
                        prix = product.prix_normal;
                    }
                    if(elementPanier.size === 'grand'){
                        prix = product.prix_grand;
                    }
                    total = total + prix * elementPanier.quantity;


                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td class="px-4 py-2 border">${product.name}</td>
                        <td class="px-4 py-2 border">${prix || ""} €</td>
                        <td class="px-4 py-2 border">${product.categorie || "Non spécifié"}</td>
                        <td class="px-4 py-2 border">${elementPanier.size || ""}</td>
                        <td class="px-4 py-2 border">${elementPanier.quantity}</td>
                    `;
                    panierElement.appendChild(row);
                });
            }

            // Affiche le total (si besoin)
            panierTotalElement.insertAdjacentHTML(
                "beforeend",
                `<p class="text-xl font-semibold">Total : ${total.toFixed(2)}€</p>`
            );
        }



        // Appelle la fonction d'affichage
        displayPanier();
});
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mon panier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between mt-8">
                        <div class=" text-2xl">
                            Mon panier
                        </div>


                    </div>

                    <div class="mt-6 text-gray-500"  id="panier">
                        <button class="text-gray-100 font-bold py-2 px-4 rounded bg-red-500" onclick="viderPanier()">Vider le panier</button>
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="uppercase text-left" >
                                    <th class="px-4 py-2 border">Produit</th>
                                    <th class="px-4 py-2 border">Prix</th>
                                    <th class="px-4 py-2 border">Catégorie</th>
                                    <th class="px-4 py-2 border">Taille</th>
                                    <th class="px-4 py-2 border">Quantité</th>
                                </tr>
                            </thead>
                            <tbody >


                            </tbody>
                        </table>
                        <div class="flex  items-center justify-center space-x-8" id="panierTotal" >
                            <a href="{{ route('products.create') }} "
                                class="text-gray-500 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">Valider ma commande</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
