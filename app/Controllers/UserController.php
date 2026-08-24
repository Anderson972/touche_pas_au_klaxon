<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Core\Access;
use Anderson\TouchePasAuKlaxon\Models\UserModel;


class UserController
{
    public function listUsers()
    {
        Access::adminAccess();

        $userModel = new UserModel;
        $users = $userModel -> findUsers();
        require __DIR__.'/../../Template/admin_users.php';
    }
};