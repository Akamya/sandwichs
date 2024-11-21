<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ma commande') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between mt-8">
                        <div class=" text-2xl">
                            Ma commande
                        </div>


                    </div>

                    <div class="mt-6 text-gray-500">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="uppercase text-left">
                                    <th class="px-4 py-2 border">Produit</th>
                                    <th class="px-4 py-2 border">Prix</th>
                                    <th class="px-4 py-2 border">Prix normal</th>
                                    <th class="px-4 py-2 border">Prix grand</th>
                                    <th class="px-4 py-2 border">Catégorie</th>
                                    <th class="px-4 py-2 border">Description</th>
                                    <th class="px-4 py-2 border">Catégorie</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr class="hover:bg-gray-50 odd:bg-gray-100 hover:odd:bg-gray-200 transition">
                                        <td class="border px-4 py-2">
                                            {{ $product->name }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $product->prix }} €</td>
                                        <td class="border px-4 py-2">
                                            {{ $product->prix_normal }} €</td>
                                        <td class="border px-4 py-2">
                                            {{ $product->prix_grand }} €</td>
                                        <td class="border px-4 py-2">
                                            {{ $product->categorie }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $product->description }}</td>
                                        <td class="border px-4 py-2 space-x-4">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="text-blue-400">Edit</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex  items-center justify-center space-x-8">
                            <a href="{{ route('products.create') }}"
                                class="text-gray-500 font-bold py-2 px-4 rounded hover:bg-gray-200 transition">Ajouter un
                                produit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
