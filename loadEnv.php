<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/');// Chargement des variables d'environnement depuis le fichier .env
$dotenv->load();

require_once __DIR__ . '/vendor/autoload.php';