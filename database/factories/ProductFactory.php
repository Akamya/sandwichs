<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

function takePrice(string $colonneName, $product){
    if(isset($product[$colonneName])){
        return str_replace(['€', ','], ['', '.'], $product[$colonneName]);
    }
    else{
        return null;
    }
 }
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return void
     */

     protected $model = \App\Models\Product::class;



    public function definition(): void
    {
        // Charger les données JSON depuis un fichier
        $json = File::get(database_path('\products.json')); // Chemin vers le fichier JSON
        $productCategories = json_decode($json, true); // Décoder le JSON en tableau associatif

        // Parcourir chaque catégorie de produits dans le JSON
        foreach ($productCategories as $category => $products) {
            // Boucle sur chaque produit dans la catégorie
            foreach ($products as $product) {
                // Utiliser la méthode create() pour insérer chaque produit dans la base de données
                DB::table('sandwich_products')->insert([
                    'name' => $product['nom'],
                    'prix' => takePrice('prix', $product),
                    'prix_normal' => takePrice('prix_normal', $product),
                    'prix_grand' => takePrice('prix_grand', $product),
                    'categorie' => is_array($category) ? implode(', ', $category) : $category, // Si $category est un tableau, le convertir en chaîne
                    'description' => isset($product['description']) ? (is_array($product['description']) ? implode(', ', $product['description']) : $product['description']) : null,
                    'img' => isset($product['img']) ? $product['img'] : null
                ]);

            }
        }
    }
}
