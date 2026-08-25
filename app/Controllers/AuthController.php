<?php

namespace Anderson\TouchePasAuKlaxon\Controllers;

use Anderson\TouchePasAuKlaxon\Models\UserModel;

/**
 * Controller gérant l'authentification (connexion et déconnexion).
 */
class AuthController
{
    /**
     * Traite la soumission du formulaire de connexion.
     *
     * Vérifie l'email et le mot de passe, initialise la session en cas
     * de succès, puis redirige vers /admin ou /connected selon le rôle.
     *
     * @return void
     */
    public function login(){

        $userModel = new UserModel();

        session_start();

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userModel -> findByEmail($email);

        if ($user) {
            if (password_verify($password, $user['password'])){
                $_SESSION['id_user'] = $user['id_users'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['telephone'] = $user['telephone'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                if ($user['role'] == 'admin') {
                    header('Location: /admin');
                    exit();
                }else{
                    header('Location: /connected');
                    exit();
                }
            }else {
                $_SESSION['message'] = 'Le mot de passe est incorrecte';
                header('Location: /login');
                exit();
            };
        }else {
            $_SESSION['message'] = 'Utilisateur introuvable';
            header('Location: /login');
            exit();
        }
    }

    /**
     * Déconnecte l'utilisateur en détruisant la session.
     *
     * @return void
     */
    public function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header('Location: /');
        exit();
    }
};