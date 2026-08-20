<?php

namespace Anderson\TouchePasAuKlaxon\Core;

use PDO;

class Database
{
    private static ?PDO $instance = null;

    public static function getConnection(): PDO
    {
        if (self::$instance === null) {
            $_ENV['DB_PORT'] = $_ENV['DB_PORT'] ?? '3306';
            $_ENV['DB_HOST'] = $_ENV['DB_HOST'] ?? 'localhost';
            $_ENV['DB_NAME'] = $_ENV['DB_NAME'] ?? 'touche_pas_au_klaxon';
            $_ENV['DB_USER'] = $_ENV['DB_USER'] ?? 'root';
            $_ENV['DB_PASSWORD'] = $_ENV['DB_PASSWORD'] ?? '';
            $dsn = "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']};charset=utf8mb4";
            self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Pour afficher les erreurs SQL
        }
        return self::$instance;
    }
}