<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Core\Access;
use Anderson\TouchePasAuKlaxon\Models\AgenceModel;
use PhpParser\Node\Stmt\TryCatch;

class AgenceController
{
    public function listAgencies()
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();
        require __DIR__.'/../../Template/admin_agencies.php';
    }

    public function create()
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();
        
        foreach ($agencies as $agency){
            if (ucfirst(strtolower($_POST['ville'])) == $agency['villes']) {
                $_SESSION['message'] = 'Cette agence existe déja !';
                header('Location: /admin/agencies');
                exit();
            }
        }

        $agenceModel = new AgenceModel();
        $success = $agenceModel -> createAgengy(ucfirst(strtolower($_POST['ville'])));
        if ($success) {
            $_SESSION['message'] = 'Agence créé avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la création de l\'agence !';
        }
        header('Location: /admin/agencies');
       exit();
    }

    public function agencyData($idAgence)
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $data = $agenceModel -> findAgency($idAgence);
        require __DIR__.'/../../Template/form_agency.php';
    }

    public function update($idAgence)
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();

        foreach ($agencies as $agency){
            if (ucfirst(strtolower($_POST['ville'])) == $agency['villes']) {
                $_SESSION['message'] = 'Cette agence existe déja !';
                header('Location: /admin/agencies');
                exit();
            }
        }
        

        $agenceModel = new AgenceModel();
        $success = $agenceModel -> updateAgency(ucfirst(strtolower($_POST['ville'])), $idAgence);


        if ($success) {
            $_SESSION['message'] = 'Agence modifiée avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la modification de l\'agence !';
        }
        header('Location: /admin/agencies');
       exit();
    }

    public function delete($idAgence)
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        try {
            $success = $agenceModel -> deleteAgency($idAgence);
            if ($success) {
            $_SESSION['message'] = 'Agence supprimer avec succès !';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression de l\'agence !';
        }
        } catch (\PDOException $e) {
            $_SESSION['message'] = 'Un trajet est programmer avec cette agence !';
        }
        
       header('Location: /admin/agencies');
       exit();
    }

}