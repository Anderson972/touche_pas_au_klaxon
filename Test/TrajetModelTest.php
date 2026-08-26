<?php

namespace Anderson\TouchePasAuKlaxon\Test;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PHPUnit\Framework\TestCase;
use Anderson\TouchePasAuKlaxon\Models\TrajetModel;
use DateTime;


class TrajetModelTest extends TestCase
{

    public function testCreateRide()
    {
        // Arrange : des valeurs de test fixes
        $gdh_depart = '2027-01-01 10:00:00';
        $gdh_arrivee = '2027-01-01 12:00:00';
        $agence_depart = 1; 
        $agence_arrivee = 2; 
        $auteur = 1; 
        $place_totale = 3;

        // Act : on appelle la VRAIE méthode du VRAI Model
        $trajetModel = new TrajetModel();
        $result = $trajetModel->createRide($gdh_depart, $gdh_arrivee, $agence_depart, $agence_arrivee, $auteur, $place_totale);

        // Assert : on vérifie le résultat
        $this->assertTrue($result);

        // Suppression du trajet créé
        $pdo = Database::getConnection();
        $idTrajet = $pdo->lastInsertId();
        $sql = "DELETE FROM Trajets WHERE id_trajets = :id_trajet";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id_trajet' => $idTrajet]);
    }

    public function testUpdateRide()
    {
        $depart = date('Y-m-d H:i:s');
        $arrivee = date('Y-m-d H:i:s', strtotime('+2 hours'));

        // Arrange : des valeurs de test fixes
        $gdh_depart = $depart;
        $gdh_arrivee = $arrivee;
        $agence_depart = 2; 
        $agence_arrivee = 3; 
        $auteur = 1; 
        $place_totale = 3;
        $idTrajet = 1;

        // Act : on appelle la VRAIE méthode du VRAI Model
        $trajetModel = new TrajetModel();
        $result = $trajetModel->updateRide($gdh_depart, $gdh_arrivee, $agence_depart, $agence_arrivee, $auteur, $place_totale, $idTrajet);

        // Assert : on vérifie le résultat
        $this->assertTrue($result);
    }

    public function testDeleteRide()
    {
        // Arrange : insertion directe d'un trajet de test
        $pdo = Database::getConnection();
        $sql = "INSERT INTO Trajets (GDH_depart, GDH_arrivee, fk_id_agences_depart, fk_id_agences_arrivee, fk_id_users, nb_places_total, nb_places_dispo) 
                VALUES (:GDH_depart, :GDH_arrivee, :agence_depart, :agence_arrivee, :auteur, :place_totale, :place_dispo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':GDH_depart' => '2027-01-01 10:00:00',
            ':GDH_arrivee' => '2027-01-01 12:00:00',
            ':agence_depart' => 1,
            ':agence_arrivee' => 2,
            ':auteur' => 1,
            ':place_totale' => 3,
            ':place_dispo' => 3
        ]);
        $idTrajet = $pdo->lastInsertId();

        // Act
        $trajetModel = new TrajetModel();
        $result = $trajetModel->deleteRide($idTrajet, 1);

        // Assert
        $this->assertTrue($result);
    }

    public function testDeleteRideAdmin()
    {
        // Arrange : insertion directe d'un trajet de test
        $pdo = Database::getConnection();
        $sql = "INSERT INTO Trajets (GDH_depart, GDH_arrivee, fk_id_agences_depart, fk_id_agences_arrivee, fk_id_users, nb_places_total, nb_places_dispo) 
                VALUES (:GDH_depart, :GDH_arrivee, :agence_depart, :agence_arrivee, :auteur, :place_totale, :place_dispo)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':GDH_depart' => '2027-01-01 10:00:00',
            ':GDH_arrivee' => '2027-01-01 12:00:00',
            ':agence_depart' => 1,
            ':agence_arrivee' => 2,
            ':auteur' => 1,
            ':place_totale' => 3,
            ':place_dispo' => 3
        ]);
        $idTrajet = $pdo->lastInsertId();

        // Act
        $trajetModel = new TrajetModel();
        $result = $trajetModel->deleteRideAdmin($idTrajet);

        // Assert
        $this->assertTrue($result);
    }
}