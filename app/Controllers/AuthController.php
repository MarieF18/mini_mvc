<?php
// Active le mode strict pour la vérification des types
declare(strict_types=1);
// Déclare l'espace de noms pour ce contrôleur
namespace Mini\Controllers;
// Importe la classe de base Controller du noyau
use Mini\Core\Controller;
use Mini\Models\User;

final class AuthController extends Controller  {
    public function register() {
        $error = null;

        //Vérification des champs de saisies (method post)
        //Si ils sont tous existant :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Création d'un nouvel utilisateur (class User)
            $userModel = new User();

            //
            $userModel->setNom($_POST['nom']);
            $userModel->setEmail($_POST['mail']);
            $userModel->setPwd($_POST['pwd']);
            if ($userModel->register()) {
                header("Location: /connexion");
                exit;
            } else {
                $error = "Erreur lors de l'inscription.";
            }
        };
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('user/co-insc/inscription', params: [
            // Définit le titre transmis à la vue
            'title' => 'Inscription',
            'error'=> $error,
        ]);
    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = User::login($_POST['mail'], $_POST['pwd']);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: /produit");
                exit;
            } else {
                $error = "Identifiants incorrects.";
            }
        }

        
        // Appelle le moteur de rendu avec la vue et ses paramètres
        $this->render('user/co-insc/connexion', params: [
            // Définit le titre transmis à la vue
            'title' => 'Connexion',
            'error'=> $error,
        ]);
    }

    public static function sessionVerif() {
        if (!isset($_SESSION['user'])){
            header("Location: /connexion");
            exit;
        }
    }

    public static function logout() {
        session_destroy();
        header("Location: /produit");
        exit;
    }
}