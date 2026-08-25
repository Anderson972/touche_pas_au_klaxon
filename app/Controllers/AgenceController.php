<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Core\Access;
use Anderson\TouchePasAuKlaxon\Models\AgenceModel;


/**
 * Controller gérant les agences côté administrateur.
 */
class AgenceController
{
    /**
     * Affiche la liste des agences pour l'administrateur.
     *
     * @return void
     */
    public function listAgencies()
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();
        require __DIR__.'/../../Template/admin_agencies.php';
    }

    /**
     * Traite la soumission du formulaire de création d'une agence.
     *
     * Bloque la création si une agence du même nom (normalisé en casse)
     * existe déjà.
     *
     * @return void
     */
    public function create()
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $agencies = $agenceModel -> getAgencies();
        
        foreach ($agencies as $agency){
            if (ucfirst(strtolower($_POST['ville'])) == $agency['villes']) {
                $_SESSION['message'] = 'Cette agence existe déja !';
                header('Location: /admin/agencies/form_agency');
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

    /**
     * Affiche le formulaire de modification d'une agence, pré-rempli.
     *
     * @param int $idAgence Identifiant de l'agence à modifier.
     * @return void
     */
    public function agencyData($idAgence)
    {
        Access::adminAccess();

        $agenceModel = new AgenceModel();
        $data = $agenceModel -> findAgency($idAgence);
        require __DIR__.'/../../Template/form_agency.php';
    }

    /**
     * Traite la soumission du formulaire de modification d'une agence.
     *
     * Bloque la modification si une autre agence porte déjà le même nom.
     *
     * @param int $idAgence Identifiant de l'agence à modifier.
     * @return void
     */
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

    /**
     * Traite la suppression d'une agence.
     *
     * Intercepte l'exception levée si l'agence est encore référencée
     * par un trajet (contrainte de clé étrangère), pour afficher un
     * message clair plutôt que de forcer la suppression.
     *
     * @param int $idAgence Identifiant de l'agence à supprimer.
     * @return void
     */
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