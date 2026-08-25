<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

/**
 * Model gérant l'accès aux données de la table Users.
 */
class UserModel
{
    /**
     * Recherche un utilisateur à partir de son adresse email.
     *
     * @param string $email Adresse email de l'utilisateur recherché.
     * @return array|false Les données de l'utilisateur (dont le mot de passe haché), ou false si introuvable.
     */
    public function findByEmail($email)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':email'=>$email]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère la liste des utilisateurs (sans mot de passe ni rôle).
     *
     * @return array Tableau des utilisateurs (nom, prénom, téléphone, email).
     */
    public function findUsers()
    {
        $pdo = Database::getConnection();

        $sql = "SELECT nom, prenom, telephone, email FROM Users";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
};