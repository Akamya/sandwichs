<x-app-layout>
    <script>
    const userID = @json($userID);
    const panierUserID = `panier-${userID}`;
    // Récupère les données du localStorage
    const savedPanier = JSON.parse(localStorage.getItem(panierUserID)) || [];
    function supprimerElement(productID){
           const updatedPanier = savedPanier.filter(element => element.productId !== productID);
           localStorage.setItem(panierUserID, JSON.stringify(updatedPanier));
        //    console.log(productID);
           location.reload();
        }
    function viderPanier(){
        localStorage.removeItem(panierUserID);
        location.reload();
    }
    document.addEventListener("DOMContentLoaded", () => {
        const panierElement = document.querySelector("#panier tbody");
        const panierTotalElement = document.querySelector("#panierTotal");

        const products = {!! json_encode($products) !!}; // Encode les produits en JSON

            // console.log(products);

        let total = 0;

        // Fonction pour afficher le panier
        function displayPanier() {
            // Attache l'événement au bouton
            const validerCommandeButton = document.querySelector("#valider");
                    validerCommandeButton.addEventListener("click", function(event) {
                        validerCommande();
                    });

                    // Fonction pour valider la commande
                    function validerCommande() {
                        console.log('cc');
                        fetch("{{ route('order.store') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({
                                panier: savedPanier,
                                total: total,
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Commande validée avec succès !");
                                // Optionnellement, vider le panier
                                localStorage.removeItem(panierUserID);
                                location.reload();
                            } else {
                                alert("Une erreur est survenue lors de la validation de la commande.");
                            }
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                            alert("Une erreur est survenue.");
                        });
                    }


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
                        <td class="px-4 py-2 border">
                            <button onclick="supprimerElement(${product.id})">Supprimer</button>
                        </td>
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
                                    <th class="px-4 py-2 border">Action</th>
                                </tr>
                            </thead>
                            <tbody >


                            </tbody>
                        </table>
                        <div class="flex  items-center justify-center space-x-8" id="panierTotal" >
                            <div id="valider" class="text-gray-500 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">Valider ma commande</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
