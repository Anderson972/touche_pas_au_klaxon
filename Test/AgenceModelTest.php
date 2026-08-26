<?php

namespace Anderson\TouchePasAuKlaxon\Test;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PHPUnit\Framework\TestCase;
use Anderson\TouchePasAuKlaxon\Models\AgenceModel;


class AgenceModelTest extends TestCase
{
    public function testCreatAgency()
    {
        // Arrange : des valeurs de test fixes
        $ville = 'VilleTest';

        // Act : on appelle méthode du VRAI Model
        $agenceModel = new AgenceModel();
        $result = $agenceModel->createAgengy($ville);

        // Assert : résultat
        $this->assertTrue($result);
        
        // Suppression de la ville créée
        $pdo = Database::getConnection();
        $idAgence = $pdo->lastInsertId();
        $sql = "DELETE FROM Agences WHERE id_agences = :id_agence";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':id_agence' => $idAgence]);
    }

    public function testUpdateAgency()
    {
        $villeTest = 'VilleTest' . rand(1, 99999);
        // Arrange : des valeurs de test fixes
        $ville = $villeTest;
        $idAgence = 1;

        // Act : on appelle méthode du VRAI Model
        $agenceModel = new AgenceModel();
        $result = $agenceModel->updateAgency($ville,$idAgence);

        // Assert : résultat
        $this->assertTrue($result);
    }

    public function testDeleteAgency()
    {
        // Arrange : insertion directe d'un trajet de test
        $pdo = Database::getConnection();
        $sql = "INSERT INTO Agences (villes) 
                VALUES (:ville)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':ville' => 'villedelete'
        ]);
        $idAgence = $pdo->lastInsertId();

        // Act
        $agenceModel = new AgenceModel();
        $result = $agenceModel->deleteAgency($idAgence);

        // Assert
        $this->assertTrue($result);
    }
}