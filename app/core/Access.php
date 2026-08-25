<?php

namespace Anderson\TouchePasAuKlaxon\Core;

/**
 * Classe utilitaire de contrôle d'accès.
 *
 * Regroupe les vérifications de session utilisées pour protéger
 * les routes réservées aux utilisateurs connectés et aux administrateurs.
 */
class Access
{
    /**
     * Vérifie que l'utilisateur est connecté.
     *
     * Démarre la session et redirige vers la page de connexion
     * si aucun identifiant utilisateur n'est présent en session.
     *
     * @return void
     */
    public static function usersAccess()
    {
        session_start();
        if (!isset($_SESSION['id_user'])) {
            header('Location: /login');
            exit();
        }
    }

    /**
     * Vérifie que l'utilisateur connecté a le rôle administrateur.
     *
     * Réutilise usersAccess() pour s'assurer que l'utilisateur est
     * connecté, puis vérifie son rôle en session.
     *
     * @return void
     */
    public static function adminAccess()
    {
        self::usersAccess();

        if ($_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit();
        }
    }
}