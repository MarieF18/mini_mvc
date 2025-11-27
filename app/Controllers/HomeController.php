<?php
// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\User;
use Mini\Models\Product;
use Mini\Models\Categorie;

// Déclare la classe finale HomeController qui hérite de Controller
final class HomeController extends Controller
{
    // Déclare la méthode d'action par défaut qui ne retourne rien
    public function accueil(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/accueil', params: [
            // Définit le titre transmis à la vue
            'title' => 'Nos Produits',
            'products' => $products = Product::getAll(),
            'categories' => $categories = Categorie::getAll(),
        ]);
    }

    public function users(): void
    {
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('home/users', params: [
            // Définit le titre transmis à la vue
            'title' => 'Liste des Utilisateurs',
            'users' => $users = User::getAll(),
        ]);
    }
}