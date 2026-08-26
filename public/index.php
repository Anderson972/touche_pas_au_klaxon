<?php

use Anderson\TouchePasAuKlaxon\Controllers\AdminController;
use Anderson\TouchePasAuKlaxon\Controllers\AgenceController;
use Anderson\TouchePasAuKlaxon\Controllers\TrajetController;
use Buki\Router\Router; 
use Anderson\TouchePasAuKlaxon\Controllers\AuthController;
use Anderson\TouchePasAuKlaxon\Controllers\UserController;
use Anderson\TouchePasAuKlaxon\Models\UserModel;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');// Chargement des variables d'environnement depuis le fichier .env
$dotenv->load();

$router = new Router(); 

/*
--------------------------------
              Users
--------------------------------
*/
// Route pour la page d'accueil
$router -> get('/', function(){ 
    $TrajetController = new TrajetController();
    $TrajetController -> home();
});

// Routes pour la creation de trajet
$router -> get('/connected/form_ride', function(){
    $TrajetController = new TrajetController;
    $TrajetController -> dataForm();
});
$router -> post('/connected/form_ride/create_ride', function(){
    $TrajetController = new TrajetController();
    $TrajetController-> create();
});

// Route pour le formulaire de connexion
$router -> get('/login', function(){
    session_start();
    require __DIR__.'/../Template/login.php';
});
$router -> post('/login', function(){
    $AuthController = new AuthController();
    $AuthController -> login();
});
$router -> get('/logout', function(){
    $AuthController = new AuthController();
    $AuthController -> logout();
});

// Route accueil utilisateur connecté
$router -> get('/connected', function(){ 
    $TrajetController = new TrajetController();
    $TrajetController -> homeConnected();
});
// Route pour infos supp. dans la modale
$router -> get('/connected/detail/:id', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> modalConnected($id);
});

// Route pour récupérer les données d'un trajet
$router -> get('/connected/form_ride/:id', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> dataRide($id);
});

// Route pour modifier un trajet 
$router -> post('/connected/form_ride/:id/update_ride', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> update($id);
});

// Route pour supprimer un trajet
$router -> post('/connected/delete_ride/:id', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> delete($id);
});
/*
--------------------------------
           Admin
--------------------------------
*/
// Route pour Tableau de bord
$router -> get('/admin', function(){ 
    $AdminController = new AdminController();
    $AdminController -> adminHome();
});

// Route pour afficher la liste utilisateurs
$router -> get('/admin/users', function(){ 
    $UserController = new UserController();
    $UserController -> listUsers();
});

// Route pour afficher la liste des agences
$router -> get('/admin/agencies', function(){ 
    $AgenceController = new AgenceController();
    $AgenceController -> listAgencies();
});

// Route pour afficher le formulaire de création d'agence
$router -> get('/admin/agencies/form_agency', function(){ 
    $AdminController = new AdminController();
    $AdminController -> adminFormAgency();
});
$router -> post('/admin/agencies/form_agency/create_agency', function(){ 
    $AgenceController = new AgenceController();
    $AgenceController -> create();
});

// Route pour récupérer et modiffier les données d'une agence
$router -> get('/admin/agencies/form_agency/:id', function($id){ 
    $AgenceController = new AgenceController();
    $AgenceController -> agencyData($id);
});
$router -> post('/admin/agencies/form_agency/:id/update_agency', function($id){ 
    $AgenceController = new AgenceController();
    $AgenceController -> update($id);
});

// Route pour supprimer une agence
$router -> post('/admin/agencies/delete_agency/:id', function($id){ 
    $AgenceController = new AgenceController();
    $AgenceController -> delete($id);
});

// Route pour afficher la liste utilisateurs
$router -> get('/admin/rides', function(){ 
    $TrajetController = new TrajetController;
    $TrajetController -> adminRides();
});
// Route pour afficher les infos supplementaires dans la modale
$router -> get('/admin/rides/detail/:id', function($id){ 
    $TrajetController = new TrajetController;
    $TrajetController -> modalConnected($id);
});

// Route pour supprimer un trajet
$router -> post('/admin/rides/delete_ride/:id', function($id){ 
    $TrajetController = new TrajetController;
    $TrajetController -> adminDelete($id);
});

$router->run();