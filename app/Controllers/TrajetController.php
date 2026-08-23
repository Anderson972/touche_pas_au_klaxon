<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Models\TrajetModel;
use Anderson\TouchePasAuKlaxon\Models\AgenceModel;
use Anderson\TouchePasAuKlaxon\Core\Access;
use Anderson\TouchePasAuKlaxon\Models\UserModel;
use DateTime;

class TrajetController
{
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

    public function dataRide($idTrajet)
    {
        Access::usersAccess();
        $trajetModel = new TrajetModel;
        $data = $trajetModel -> findDataRide($idTrajet);

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();
        require __DIR__.'/../../Template/form_ride.php'; 
    }

    public function dataForm()
    {
        Access::usersAccess();

        $agenceModel = new AgenceModel();

        $agencies = $agenceModel -> getAgencies();

        require __DIR__.'/../../Template/form_ride.php';

    }

    public function homeConnected()
    {
        Access::usersAccess();

        $trajetModel = new TrajetModel();
        $rides = $trajetModel -> findRides();

        
        require __DIR__.'/../../Template/connected.php';
    }

    public function modalConnected($idTrajet)
    {
        Access::usersAccess();
        $trajetModel = new TrajetModel();
        $rideDetail = $trajetModel -> findRideDetail($idTrajet);
        header('Content-Type: application/json');
        echo json_encode($rideDetail);
        exit();

    }

    public function home()
    {
        $trajetModel = new TrajetModel();
        $rides = $trajetModel -> findRides();
        require __DIR__.'/../../Template/home.php';
    }

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
};