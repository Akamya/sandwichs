<x-guest-layout>
    <script>
        const panier = [];
        function changePrice(size, sandwichID){
            // console.log('sandwichID', sandwichID)
            const prixGrand = document.querySelector(`#prix-${sandwichID}-grand`);
            const prixNormal = document.querySelector(`#prix-${sandwichID}-normal`);
            // console.log(size.value);
            if(size.value === 'normal'){
                prixGrand.classList.add('hidden');
                prixNormal.classList.remove('hidden');
                // console.log('hello1')
            }else{
                prixNormal.classList.add('hidden');
                prixGrand.classList.remove('hidden');
                // console.log('hello2')

            }
            // console.log('Grand', prixGrand, 'Normal', prixNormal)
        }

        function ajouterProduit(productId) {
        // Récupérer la quantité sélectionnée pour ce produit
        const quantity = document.getElementById(`quantity-${productId}`).value;
        const size = document.querySelector(`#size-${productId}`)?.value;

        // Panier
        const existingProduct =panier.find(product => product.productId === productId);
        if(existingProduct){
            existingProduct.quantity += parseInt(quantity, 10);
        }
        else{
            panier.push({productId, quantity:parseInt(quantity, 10), size});
        }

        console.log('panier',panier);
        localStorage.setItem("panier", JSON.stringify(panier));

        if(size){
            console.log(`Produit ID ${productId} ajouté avec ${quantity} unités en taille ${size}.`);
        }
        else{
            // Vous pouvez ici ajouter le produit avec la quantité choisie à un panier
            console.log(`Produit ID ${productId} ajouté avec ${quantity} unités.`);
        }


        // Exemple d'envoi vers un panier (ex : via une requête AJAX)
        // axios.post('/ajouter-au-panier', { id: productId, quantity: quantity });
    }
    </script>
    <h1 class="font-bold text-3xl mb-8 text-center text-gray-800">Liste des produits</h1>

    <div class="space-y-12">
        <!-- Boissons froides -->
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Boissons froides</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                @foreach($products->filter(function ($element) { return $element->categorie == 'Boissons froides';}) as $product)
                    <li>
                        <a class="flex flex-col bg-white rounded-lg shadow-lg p-6 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xl font-semibold text-gray-700">{{ $product->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $product->description ?? 'Description du produit' }}</p>
                            <div class="mt-4 flex justify-between items-center text-lg font-medium text-gray-700">
                                <span>{{ $product->prix ?? 'Prix non défini' }} €</span>
                                <!-- Champ de quantité -->
                                <div class="flex items-center space-x-2">
                                    <input type="number" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded-md text-center" id="quantity-{{ $product->id }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
                                            onclick="ajouterProduit({{ $product->id }})">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Boissons chaudes -->
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Boissons chaudes</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                @foreach($products->filter(function ($element) { return $element->categorie == 'Boissons chaudes';}) as $product)
                    <li>
                        <a class="flex flex-col bg-white rounded-lg shadow-lg p-6 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xl font-semibold text-gray-700">{{ $product->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $product->description ?? 'Description du produit' }}</p>
                            <div class="mt-4 flex justify-between items-center text-lg font-medium text-gray-700">
                                <span>{{ $product->prix ?? 'Prix non défini' }} €</span>
                                <!-- Champ de quantité -->
                                <div class="flex items-center space-x-2">
                                    <input type="number" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded-md text-center" id="quantity-{{ $product->id }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
                                            onclick="ajouterProduit({{ $product->id }})">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Sandwiches Classiques -->
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Sandwiches Classiques</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                @foreach($products->filter(function ($element) { return $element->categorie == 'Sandwiches Classiques';}) as $product)
                    <li>
                        <div class="flex flex-col bg-white rounded-lg shadow-lg p-6 w-full">
                            @csrf
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xl font-semibold text-gray-700">{{ $product->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $product->description ?? 'Description du produit' }}</p>
                            <div class="mt-4 flex justify-between items-center text-lg font-medium text-gray-700">

                                <!-- Sélectionner la taille -->
                                <div class="flex space-x-4">
                                    <label for="size-{{ $product->id }}" class="text-gray-600">Choisir la taille:</label>
                                    <select onchange="changePrice(this, {{$product->id}})" name="size" id="size-{{ $product->id }}" class="w-32 p-2 border border-gray-300 rounded-md">
                                        <option value="normal" selected>Normal</option>
                                        <option value="grand">Grand</option>
                                    </select>
                                </div>

                                <!-- Afficher les prix -->
                                <div class="flex items-center space-x-2 mt-2">
                                    <span id="prix-{{ $product->id }}-normal" class="text-gray-700">{{ $product->prix_normal ?? 'Prix non défini' }} €</span>
                                    <span id="prix-{{ $product->id }}-grand" class="text-gray-700 hidden">{{ $product->prix_grand ?? 'Prix non défini' }} €</span>
                                </div>
                            </div>

                            <!-- Champ de quantité -->
                            <div class="flex items-center space-x-2 mt-2">
                                <input type="number" name="quantity" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded-md text-center" id="quantity-{{ $product->id }}">
                            </div>

                            <!-- Bouton d'ajout au panier -->
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 mt-4" onclick="ajouterProduit({{ $product->id }})">
                                Ajouter
                            </button>

                            <!-- Hidden field pour stocker l'ID du produit -->
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>


        <!-- Sandwiches Créatifs -->
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Sandwiches Créatifs</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                @foreach($products->filter(function ($element) { return $element->categorie == 'Sandwiches Créatifs';}) as $product)
                    <li>
                        <a class="flex flex-col bg-white rounded-lg shadow-lg p-6 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xl font-semibold text-gray-700">{{ $product->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $product->description ?? 'Description du produit' }}</p>
                            <div class="mt-4 flex justify-between items-center text-lg font-medium text-gray-700">
                                <span>{{ $product->prix ?? 'Prix non défini' }} €</span>
                                <!-- Champ de quantité -->
                                <div class="flex items-center space-x-2">
                                    <input type="number" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded-md text-center" id="quantity-{{ $product->id }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
                                            onclick="ajouterProduit({{ $product->id }})">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Paninis -->
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Paninis</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                @foreach($products->filter(function ($element) { return $element->categorie == 'Paninis';}) as $product)
                    <li>
                        <a class="flex flex-col bg-white rounded-lg shadow-lg p-6 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xl font-semibold text-gray-700">{{ $product->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $product->description ?? 'Description du produit' }}</p>
                            <div class="mt-4 flex justify-between items-center text-lg font-medium text-gray-700">
                                <span>{{ $product->prix ?? 'Prix non défini' }} €</span>
                                <!-- Champ de quantité -->
                                <div class="flex items-center space-x-2">
                                    <input type="number" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded-md text-center" id="quantity-{{ $product->id }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
                                            onclick="ajouterProduit({{ $product->id }})">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Cornets de Pâtes -->
        <div class="space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Cornets de Pâtes</h2>
            <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
                @foreach($products->filter(function ($element) { return $element->categorie == 'Cornets de Pâtes';}) as $product)
                    <li>
                        <a class="flex flex-col bg-white rounded-lg shadow-lg p-6 w-full">
                            <div class="flex items-center justify-between mb-4">
                                <p class="text-xl font-semibold text-gray-700">{{ $product->name }}</p>
                            </div>
                            <p class="text-sm text-gray-500">{{ $product->description ?? 'Description du produit' }}</p>
                            <div class="mt-4 flex justify-between items-center text-lg font-medium text-gray-700">
                                <span>{{ $product->prix ?? 'Prix non défini' }} €</span>
                                <!-- Champ de quantité -->
                                <div class="flex items-center space-x-2">
                                    <input type="number" value="1" min="1" class="w-16 p-2 border border-gray-300 rounded-md text-center" id="quantity-{{ $product->id }}">
                                    <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300"
                                            onclick="ajouterProduit({{ $product->id }})">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</x-guest-layout>

