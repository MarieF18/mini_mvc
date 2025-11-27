<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Product
{
    private $id;
    private $label;
    private $prix;
    private $description;
    private $categorie;
    private $image;

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

    public function getlabel()
    {
        return $this->label;
    }

    public function setlabel($label)
    {
        $this->nom = $label;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    public function getCat()
    {
        return $this->categorie;
    }

    public function setCat($id_cat)
    {
        $this->categorie = $id_cat;
    }

    public function getImg()
    {
        return $this->image;
    }

    public function setImg($image)
    {
        $this->image = $image;
    }

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère tous les produits
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM products ORDER BY id_prod DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un produit par son ID
     * @param int $id
     * @return array|null
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id_prod = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un produit par son nom
     * @param string $nom
     * @return array|null
     */
    public static function findByEmail($nom)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM products WHERE label = ?");
        $stmt->execute([$nom]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau produit
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO products (label, prix, description, image, id_cat) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$this->label, $this->prix, $this->description, $this->image, $this->categorie]);
    }

    /**
     * Met à jour les informations d’un produit existant
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE products SET label = ?, prix = ?, description = ?, image = ?, id_cat = ? WHERE id_user = ?");
        return $stmt->execute([$this->label, $this->prix, $this->description, $this->image, $this->categorie, $this->id]);
    }

    /**
     * Supprime un produit
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM products WHERE id_prod = ?");
        return $stmt->execute([$this->id]);
    }
}