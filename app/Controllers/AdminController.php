<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Core\Access;

class AdminController
{
    public function adminHome()
    {
        Access::adminAccess();
        require __DIR__.'/../../Template/admin.php';

    }

    public function adminFormAgency()
    {
        Access::adminAccess();
        require __DIR__.'/../../Template/form_agency.php';
    }
}