<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

class AgenceModel
{
    public function getAgencies(){
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM Agences";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAgengy($ville)
    {
        $pdo = Database::getConnection();

        $sql = "INSERT INTO  Agences (villes) VALUES (:ville)";
        $stmt = $pdo -> prepare($sql);
        return $stmt -> execute([':ville' => $ville]);
    }

    public function findAgency($idAgence)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM Agences WHERE id_agences = :id_agence";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':id_agence' => $idAgence]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

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