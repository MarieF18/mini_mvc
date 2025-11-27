<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Panier
{
    private $user;
    private $product;
    private $quantity;

    // =====================
    // Getters / Setters
    // =====================

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($id_user)
    {
        $this->user = $id_user;
    }

    public function getProd()
    {
        return $this->product;
    }

    public function setProd($id_prod)
    {
        $this->product = $id_prod;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les paniers triés par utilisateur
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM paniers ORDER BY id_user DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère tous les éléments du panier d'un utilisateur par son ID
     * @param int $id_user
     * @return array|null
     */
    public static function findByUserId($id_user)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM paniers WHERE id_user = ?");
        $stmt->execute([$id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * Crée un nouveau panier
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO paniers (id_user, id_prod, quantity) VALUES (?, ?, ?)");
        return $stmt->execute([$this->user, $this->product, $this->quantity]);
    }

    /**
     * Met à jour les informations la quantité d'un produit dans le panier d'un utilisateur
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE paniers SET quantity = ? WHERE id_user = ? AND id_prod = ?");
        return $stmt->execute([$this->quantity, $this->user, $this->product]);
    }

    /**
     * Supprime un produit du panier d'un utilisateur
     * @return bool
     */
    public function deleteProd()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM paniers WHERE id_user = ? AND id_produit = ?");
        return $stmt->execute([$this->user, $this->product]);
    }


    /**
     * Supprime le panier d'un utilisateur
     * @param int $id_user
     * @return bool
     */
    public static function deletePanier($id_user)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM paniers WHERE id_user = ?");
        return $stmt->execute([$id_user]);
    }
}
