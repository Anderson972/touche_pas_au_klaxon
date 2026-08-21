<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

class TrajetModel
{

    public function createRide($gdh_depart, $gdh_arrivee, $agence_depart, $agence_arrivee, $auteur, $place_totale)
    {

        $pdo = Database::getConnection();

        $sql = "INSERT INTO Trajets (GDH_depart, GDH_arrivee, fk_id_agences_depart, fk_id_agences_arrivee, fk_id_users, nb_places_total, nb_places_dispo) 
                VALUES (:GDH_depart, :GDH_arrivee, :agence_depart, :agence_arrivee, :auteur, :place_totale, :place_dispo)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':GDH_depart' => $gdh_depart,
            ':GDH_arrivee' => $gdh_arrivee,
            ':agence_depart' => $agence_depart,
            ':agence_arrivee' => $agence_arrivee,
            ':auteur' => $auteur,
            ':place_totale' => $place_totale,
            ':place_dispo' => $place_totale
        ]);
    }

    public function findRides()
    {
        $pdo = Database::getConnection();

        $sql = "SELECT 
            dep.villes AS ville_depart,
            T.GDH_depart,
            arr.villes AS ville_arrivee,
            T.GDH_arrivee,
            T.nb_places_dispo
            FROM Trajets T
            JOIN Agences dep ON T.fk_id_agences_depart = dep.id_agences
            JOIN Agences arr ON T.fk_id_agences_arrivee = arr.id_agences
            WHERE T.GDH_depart > CURRENT_TIMESTAMP() AND T.nb_places_dispo >= 1
            ORDER BY T.GDH_depart ASC
        ";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
};