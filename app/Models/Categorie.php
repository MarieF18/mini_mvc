<?php

namespace Mini\Models;

use Mini\Core\Database;
use PDO;

class Categorie
{
    private $id;
    private $nom;

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

    // =====================
    // Méthodes CRUD
    // =====================

    /**
     * Récupère toutes les catégories
     * @return array
     */
    public static function getAll()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->query("SELECT * FROM categories ORDER BY id_cat DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une catégorie par son ID
     * @param int $id
     * @return array|null
     */
    public static function findById($id)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE id_cat = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une categorie par son nom
     * @param string $nom
     * @return array|null
     */
    public static function findByEmail($nom)
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("SELECT * FROM categories WHERE nom_cat = ?");
        $stmt->execute([$nom]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle catégorie
     * @return bool
     */
    public function save()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("INSERT INTO categories (nom) VALUES (?)");
        return $stmt->execute([$this->nom]);
    }

    /**
     * Met à jour les informations d’une catégorie existante
     * @return bool
     */
    public function update()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("UPDATE categories SET nom = ? WHERE id_cat = ?");
        return $stmt->execute([$this->nom, $this->id]);
    }

    /**
     * Supprime une catégorie
     * @return bool
     */
    public function delete()
    {
        $pdo = Database::getPDO();
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id_cat = ?");
        return $stmt->execute([$this->id]);
    }
}
