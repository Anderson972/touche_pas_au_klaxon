<?php

namespace Anderson\TouchePasAuKlaxon\Core;

class Access
{
    public static function usersAccess()
    {
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: /login');
            exit();
        }
    }

    public static function adminAccess()
    {
        self::usersAccess();

        if ($_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
    }
}