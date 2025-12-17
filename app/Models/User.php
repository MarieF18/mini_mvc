<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class User
{
    private $id;
    private $nom;
    private $email;
    private $mdp;

    // =====================
    // Getters / Setters
    // =====================

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getnom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPwd($Pwd)
    {
        $this->mdp = $Pwd;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les utilisateurs
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM users ORDER BY id_user DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     * @param int $id
     * @return array|null
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son email et vérifie le mot-de-passe
     * @param string $email $password
     * @return array|null
     */
    public static function login($email, $password)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user =  $stmt->fetch(PDO::FETCH_ASSOC);

        function console_log($data) {
            // Safely encode data to JSON for JavaScript
            $json = json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
            echo "<script>console.log($json);</script>";
        }

        console_log(password_verify($password, $user['password']));

        if ($user && password_verify($password, $user['password'])){
            return $user;
        } 
    }

    /**
     * Crée un nouvel utilisateur
     * @return bool
     */
    public function register()
    {
        $pdo = Database::getPDO();
        $hash = password_hash($this->mdp, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (nom, email, mdp) VALUES (?, ?, ?)");
        return $stmt->execute([$this->nom, $this->email, $hash]);
    }

    /**
     * Met à jour les informations d’un utilisateur existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $hash = password_hash($this->mdp, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET nom = ?, email = ?, mdp = ? WHERE id_user = ?");
        return $stmt->execute([$this->nom, $this->email, $hash, $this->id]);
    }

    /**
     * Supprime un utilisateur
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id_user = ?");
        return $stmt->execute([$this->id]);
    }
}
