<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Core\Access;

/**
 * Controller gérant le tableau de bord principal de l'administrateur.
 */
class AdminController
{
    /**
     * Affiche la page d'accueil du tableau de bord administrateur.
     *
     * @return void
     */
    public function adminHome()
    {
        Access::adminAccess();
        require __DIR__.'/../../Template/admin.php';

    }

    /**
     * Affiche le formulaire vide de création d'une agence.
     *
     * @return void
     */
    public function adminFormAgency()
    {
        Access::adminAccess();
        require __DIR__.'/../../Template/form_agency.php';
    }
}