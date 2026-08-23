<?php
use Anderson\TouchePasAuKlaxon\Controllers\TrajetController;
use Buki\Router\Router; 
use Anderson\TouchePasAuKlaxon\Controllers\AuthController;
use Anderson\TouchePasAuKlaxon\Models\UserModel;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');// Chargement des variables d'environnement depuis le fichier .env
$dotenv->load();




$router = new Router(); 

/*
--------------------------------
Définition des routes
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

$router -> get('/connected/form_ride/:id', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> dataRide($id);
});

$router -> post('/connected/form_ride/:id/update_ride', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> update($id);
});

$router -> post('/connected/delete_ride/:id', function($id){ 
    $TrajetController = new TrajetController();
    $TrajetController -> delete($id);
});

$router->run();