<?php
// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\Product;
use Mini\Models\Categorie;

final class ProductController extends Controller {
    public function detailProd(): void
    {
        // Récupéré l'id du produit dans le lien (en get)
        $id = $_GET['produit'] ?? null;

        // Vérifier qu'il y ai bien un id et qu'il ai une valeur numérique
        //Sinon retour à l'accueil
        if ($id === null || !is_numeric($id)) {
            header('Location: /');
            return;
        }

        //Trouver le produit correspondant à l'id avec la fonction static de la class User : findById
        $product = Product::findById($id);

        //Vérifier si le produit existe 
        //Sinon retour à l'accueil
        if ($product === false || $product === null) {
            header('Location: /');
            return;
        }

        //Trouver la catégorie du produit
        $categorie = (Categorie::findById($product['id_cat']));

        //Verifier si le produit a une catégorie et si elle existe
        //Si oui, $categorie prend le nom de la catégorie
        //Sinon, $categorie prend rien
        if ($categorie !== false && $categorie !== null) {
            $categorie = $categorie['nom_cat'];
        } else {
            $categorie = '';
        }
        
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('products/detailProd', params: [
            'product' => $product,
            // Définit le titre transmis à la vue
            'title' => $product['label'],
            'categorie' => $categorie,
        ]);
    }
}