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
    echo "Hello World";
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

$router->run();