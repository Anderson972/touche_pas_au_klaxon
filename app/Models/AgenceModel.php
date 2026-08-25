<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

/**
 * Model gérant l'accès aux données de la table Agences.
 */
class AgenceModel
{
    /**
     * Récupère la liste de toutes les agences.
     *
     * @return array Tableau associatif de toutes les agences (id_agences, villes).
     */
    public function getAgencies(){
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM Agences";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle agence.
     *
     * @param string $ville Nom de la ville de l'agence à créer.
     * @return bool Succès ou échec de la requête.
     */
    public function createAgengy($ville)
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO  Agences (villes) VALUES (:ville)";
        $stmt = $pdo -> prepare($sql);
        return $stmt -> execute([':ville' => $ville]);
    }

    /**
     * Récupère une agence à partir de son identifiant.
     *
     * @param int $idAgence Identifiant de l'agence recherchée.
     * @return array|false Les données de l'agence, ou false si introuvable.
     */
    public function findAgency($idAgence)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM Agences WHERE id_agences = :id_agence";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':id_agence' => $idAgence]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Modifie le nom d'une agence existante.
     *
     * @param string $ville Nouveau nom de la ville.
     * @param int $idAgence Identifiant de l'agence à modifier.
     * @return bool True si une ligne a été modifiée, false sinon.
     */
    public function updateAgency($ville, $idAgence)
    {
        $pdo = Database::getConnection();

        $sql = "UPDATE Agences SET villes = :ville WHERE id_agences = :id_agence";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':ville' => $ville, ':id_agence' => $idAgence]);
        $count = $stmt -> rowCount();
        if ($count>0) {
            return true;
        }else {return false;}
    }

    /**
     * Supprime une agence à partir de son identifiant.
     *
     * @param int $idAgence Identifiant de l'agence à supprimer.
     * @return bool True si une ligne a été supprimée, false sinon.
     */
    public function deleteAgency($idAgence)
    {
        $pdo = Database::getConnection();

        $sql = "DELETE FROM Agences WHERE id_agences = :id_agence";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':id_agence' => $idAgence]);
        $count = $stmt -> rowCount();
        if ($count>0) {
            return true;
        }else {return false;}
    }
};