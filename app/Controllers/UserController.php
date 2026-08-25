<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Core\Access;
use Anderson\TouchePasAuKlaxon\Models\UserModel;


/**
 * Controller gérant l'affichage des utilisateurs côté administrateur.
 */
class UserController
{
    /**
     * Affiche la liste des utilisateurs pour l'administrateur.
     *
     * @return void
     */
    public function listUsers()
    {
        Access::adminAccess();

        $userModel = new UserModel;
        $users = $userModel -> findUsers();
        require __DIR__.'/../../Template/admin_users.php';
    }
};