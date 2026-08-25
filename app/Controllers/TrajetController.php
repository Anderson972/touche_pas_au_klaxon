<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Models\TrajetModel;
use Anderson\TouchePasAuKlaxon\Models\AgenceModel;
use Anderson\TouchePasAuKlaxon\Core\Access;
use DateTime;

/**
 * Controller gérant les trajets côté utilisateur connecté et côté admin.
 */
class TrajetController
{
    /**
     * Traite la soumission du formulaire de création d'un trajet.
     *
     * Vérifie la cohérence des dates et des agences avant d'enregistrer
     * le trajet, avec l'auteur récupéré depuis la session (pas depuis
     * le formulaire, pour éviter toute falsification).
     *
     * @return void
     */
    public function create()
    {
        Access::usersAccess();

        $depart = new \DateTime($_POST['gdh_depart']);
        $arrivee = new \DateTime($_POST['gdh_arrivee']);

        if ($arrivee <= $depart) {
            $_SESSION['message'] = 'l\'arrivée doit être après le départ';
            header('Location: /connected/form_ride');
            exit();
        }

        if ($_POST['agence_arrivee'] === $_POST['agence_depart']) {
            $_SESSION['message'] = 'L\'agence d\'arrivée ne doit pas être identique à celle du départ';
            header('Location: /connected/form_ride');
            exit();
        };

        $trajetModel = new TrajetModel();

        $success = $trajetModel->createRide(
            $_POST['gdh_depart'],
            $_POST['gdh_arrivee'],
            $_POST['agence_depart'],
            $_POST['agence_arrivee'],
            $_SESSION['id_user'],
            $_POST['place_totale']
        );

        if ($success) {
            $_SESSION['message'] = 'Trajet créé avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la création du trajet !';
        }

       header('Location: /connected');
       exit();
    }

    /**
     * Traite la soumission du formulaire de modification d'un trajet.
     *
     * Mêmes contrôles de cohérence que create(). La modification n'est
     * effective en base que si l'utilisateur connecté est bien l'auteur.
     *
     * @param int $idTrajet Identifiant du trajet à modifier.
     * @return void
     */
    public function update($idTrajet)
    {
        Access::usersAccess();

        $depart = new \DateTime($_POST['gdh_depart']);
        $arrivee = new \DateTime($_POST['gdh_arrivee']);

        if ($arrivee <= $depart) {
            $_SESSION['message'] = 'l\'arrivée doit être après le départ';
            header('Location: /connected/form_ride/update/'.$idTrajet);
            exit();
        }

        if ($_POST['agence_arrivee'] === $_POST['agence_depart']) {
            $_SESSION['message'] = 'L\'agence d\'arrivée ne doit pas être identique à celle du départ';
            header('Location: /connected/form_ride/update/'.$idTrajet);
            exit();
        };

        $trajetModel = new TrajetModel();

        $success = $trajetModel->updateRide(
            $_POST['gdh_depart'],
            $_POST['gdh_arrivee'],
            $_POST['agence_depart'],
            $_POST['agence_arrivee'],
            $_SESSION['id_user'],
            $_POST['place_totale'],
            $idTrajet
        );

        if ($success) {
            $_SESSION['message'] = 'Trajet modifié avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la modification du trajet !';
        }

       header('Location: /connected');
       exit();
    }

    /**
     * Affiche le formulaire de modification d'un trajet, pré-rempli.
     *
     * @param int $idTrajet Identifiant du trajet à modifier.
     * @return void
     */
    public function dataRide($idTrajet)
    {
        Access::usersAccess();
        $trajetModel = new TrajetModel();
        $data = $trajetModel -> findDataRide($idTrajet);

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();
        require __DIR__.'/../../Template/form_ride.php'; 
    }

    /**
     * Affiche le formulaire vide de création d'un trajet.
     *
     * @return void
     */
    public function dataForm()
    {
        Access::usersAccess();

        $agenceModel = new AgenceModel();

        $agencies = $agenceModel -> getAgencies();

        require __DIR__.'/../../Template/form_ride.php';

    }

    /**
     * Affiche la page d'accueil de l'utilisateur connecté avec la liste des trajets.
     *
     * @return void
     */
    public function homeConnected()
    {
        Access::usersAccess();

        $trajetModel = new TrajetModel();
        $rides = $trajetModel -> findRides();
        require __DIR__.'/../../Template/connected.php';
    }

    /**
     * Retourne au format JSON les informations détaillées d'un trajet
     * (identité et contact de l'auteur, nombre total de places),
     * utilisées pour remplir la modale de détails côté client.
     *
     * @param int $idTrajet Identifiant du trajet concerné.
     * @return void
     */
    public function modalConnected($idTrajet)
    {
        Access::usersAccess();
        $trajetModel = new TrajetModel();
        $rideDetail = $trajetModel -> findRideDetail($idTrajet);
        header('Content-Type: application/json');
        echo json_encode($rideDetail);
        exit();

    }

    /**
     * Affiche la page d'accueil publique avec la liste des trajets disponibles.
     *
     * @return void
     */
    public function home()
    {
        $trajetModel = new TrajetModel();
        $rides = $trajetModel -> findRides();
        require __DIR__.'/../../Template/home.php';
    }

    /**
     * Traite la suppression d'un trajet par son auteur.
     *
     * @param int $idTrajet Identifiant du trajet à supprimer.
     * @return void
     */
    public function delete($idTrajet)
    {
        Access::usersAccess();

        $trajetModel = new TrajetModel();

        $success = $trajetModel->deleteRide(
            $idTrajet,
            $_SESSION['id_user']
        );

        if ($success) {
            $_SESSION['message'] = 'Trajet supprimer avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression du trajet !';
        }

       header('Location: /connected');
       exit();
    }

    /* 
    ---------------------------------------
                Admin
    ---------------------------------------
     */

    /**
     * Affiche la liste de tous les trajets pour l'administrateur.
     *
     * @return void
     */
    public function adminRides()
    {
        Access::adminAccess();

        $trajetModel = new TrajetModel();
        $rides = $trajetModel -> findAllRides();
        require __DIR__.'/../../Template/admin_rides.php';
    }

    /**
     * Traite la suppression d'un trajet par l'administrateur, sans
     * vérification d'auteur.
     *
     * @param int $idTrajet Identifiant du trajet à supprimer.
     * @return void
     */
    public function adminDelete($idTrajet)
    {
        Access::adminAccess();

        $trajetModel = new TrajetModel();

        $success = $trajetModel-> deleteRideAdmin($idTrajet);

        if ($success) {
            $_SESSION['message'] = 'Trajet supprimer avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression du trajet !';
        }

       header('Location: /admin/rides');
       exit();
    }

};