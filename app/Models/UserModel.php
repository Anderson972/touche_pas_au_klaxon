<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

class UserModel
{
    public function findByEmail($email)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM Users WHERE email = :email";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':email'=>$email]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public function findUsers()
    {
        $pdo = Database::getConnection();

        $sql = "SELECT nom, prenom, telephone, email FROM Users";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
};