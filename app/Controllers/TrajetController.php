<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Models\TrajetModel;
use Anderson\TouchePasAuKlaxon\Models\AgenceModel;
use DateTime;

class TrajetController
{
    public function create()
    {
        session_start();

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

    public function dataForm()
    {
        session_start();

        $agenceModel = new AgenceModel();

        $agencies = $agenceModel -> getAgencies();

        require __DIR__.'/../../Template/form_ride.php';

    }

    public function homeConnected()
    {
        session_start();

        $trajetModel = new TrajetModel();
        $rides = $trajetModel -> findRides();
        require __DIR__.'/../../Template/connected.php';
    }
};