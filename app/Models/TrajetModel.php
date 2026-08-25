<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

/**
 * Model gérant l'accès aux données de la table Trajets.
 */
class TrajetModel
{
    /**
 * Creation d'un trajets.
 *
 * @param string $gdh_depart Date et heure de départ du trajet
 * @param string $gdh_arrivee Date et heure d'arrivée du trajet
 * @param int $agence_depart Identifiant de l'agence de départ
 * @param int $agence_arrivee Identifiant de l'agence d'arrivée
 * @param int $auteur Identifiant de l'utilisateur auteur du trajet
 * @param int $place_totale Nombre total de places proposées
 * @return bool Du succes ou l'echec de la requette
 */
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

    /**
     * Modifie un trajet existant.
     *
     * La mise à jour n'est effective que si l'identifiant du trajet
     * et l'auteur correspondent tous les deux (seul l'auteur peut modifier).
     *
     * @param string $gdh_depart Date et heure de départ du trajet
     * @param string $gdh_arrivee Date et heure d'arrivée du trajet
     * @param int $agence_depart Identifiant de l'agence de départ
     * @param int $agence_arrivee Identifiant de l'agence d'arrivée
     * @param int $auteur Identifiant de l'utilisateur auteur du trajet
     * @param int $place_totale Nombre total de places proposées
     * @param int $idTrajet Identifiant du trajet à modifier
     * @return bool True si une ligne a été modifiée, false sinon.
     */
    public function updateRide($gdh_depart, $gdh_arrivee, $agence_depart, $agence_arrivee, $auteur, $place_totale, $idTrajet)
    {
        $pdo = Database::getConnection();
        $sql ="UPDATE Trajets 
                SET GDH_depart = :GDH_depart, 
                    GDH_arrivee = :GDH_arrivee, 
                    fk_id_agences_depart = :agence_depart,
                    fk_id_agences_arrivee = :agence_arrivee,
                    nb_places_total = :place_totale,
                    nb_places_dispo = :place_dispo
                WHERE id_trajets = :id_trajet AND fk_id_users = :auteur";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute([
            ':GDH_depart' => $gdh_depart,
            ':GDH_arrivee' => $gdh_arrivee,
            ':agence_depart' => $agence_depart,
            ':agence_arrivee' => $agence_arrivee,
            ':auteur' => $auteur,
            ':place_totale' => $place_totale,
            ':place_dispo' => $place_totale,
            ':id_trajet' => $idTrajet
        ]);
        $count = $stmt -> rowCount();
        if ($count>0) {
            return true;
        }else {return false;}
    }

    /**
     * Récupère les données brutes d'un trajet (pour pré-remplir un formulaire).
     *
     * @param int $idTrajet Identifiant du trajet recherché.
     * @return array|false Les données du trajet, ou false si introuvable.
     */
    public function findDataRide($idTrajet)
    {
        $pdo = Database::getConnection();
        $sql ="SELECT * FROM Trajets Where Trajets.id_trajets = :id_trajet";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute([':id_trajet' => $idTrajet]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère la liste des trajets disponibles (places restantes, date future).
     *
     * @return array Tableau des trajets triés par date de départ croissante.
     */
    public function findRides()
    {
        $pdo = Database::getConnection();

        $sql = "SELECT 
            dep.villes AS ville_depart,
            T.GDH_depart,
            arr.villes AS ville_arrivee,
            T.GDH_arrivee,
            T.nb_places_dispo,
            T.id_trajets,
            T.fk_id_users
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

    /**
     * Récupère les informations de contact de l'auteur d'un trajet.
     *
     * @param int $idTrajet Identifiant du trajet concerné.
     * @return array Tableau contenant nom, prénom, téléphone, email et nombre total de places.
     */
    public function findRideDetail($idTrajet)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT usr.nom, usr.prenom, usr.telephone, usr.email, T.nb_places_total
                FROM Trajets T 
                LEFT JOIN Users usr on T.fk_id_users=usr.id_users 
                WHERE T.id_trajets = :id_trajets;
        ";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute([':id_trajets' => $idTrajet]);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime un trajet (réservé à son auteur).
     *
     * La suppression n'est effective que si l'identifiant du trajet
     * et l'auteur correspondent tous les deux.
     *
     * @param int $idTrajet Identifiant du trajet à supprimer.
     * @param int $auteur Identifiant de l'utilisateur demandant la suppression.
     * @return bool True si une ligne a été supprimée, false sinon.
     */
    public function deleteRide($idTrajet, $auteur)
    {
        $pdo = Database::getConnection();

        $sql = "DELETE FROM Trajets WHERE Trajets.id_trajets = :id_trajet AND fk_id_users = :auteur";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute([
            ':id_trajet' => $idTrajet,
            ':auteur' => $auteur
            ]);
        $count = $stmt -> rowCount();
        if ($count>0) {
            return true;
        }else {return false;};
    }
    /*
    ---------------------------------------------
                Admin
    ---------------------------------------------            
     */

    /**
     * Récupère la liste de tous les trajets, sans filtre (vue admin).
     *
     * @return array Tableau de tous les trajets triés par date de départ croissante.
     */
    public function findAllRides()
    {
        $pdo = Database::getConnection();

        $sql = "SELECT 
            dep.villes AS ville_depart,
            T.GDH_depart,
            arr.villes AS ville_arrivee,
            T.GDH_arrivee,
            T.nb_places_dispo,
            T.id_trajets,
            T.fk_id_users
            FROM Trajets T
            JOIN Agences dep ON T.fk_id_agences_depart = dep.id_agences
            JOIN Agences arr ON T.fk_id_agences_arrivee = arr.id_agences
            ORDER BY T.GDH_depart ASC
        ";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Supprime un trajet sans vérification d'auteur (réservé à l'admin).
     *
     * @param int $idTrajet Identifiant du trajet à supprimer.
     * @return bool True si une ligne a été supprimée, false sinon.
     */
    public function deleteRideAdmin($idTrajet)
    {
        $pdo = Database::getConnection();

        $sql = "DELETE FROM Trajets WHERE Trajets.id_trajets = :id_trajet";
        $stmt = $pdo -> prepare($sql);
        $stmt->execute([
            ':id_trajet' => $idTrajet
            ]);
        $count = $stmt -> rowCount();
        if ($count>0) {
            return true;
        }else {return false;};
    }
};