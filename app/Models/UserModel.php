<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

class UserModel
{
    public function findByEmail($email)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM `Users` WHERE `email` = :email";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':email'=>$email]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $pdo = Database::getConnection();

        $sql = "SELECT `nom`, `prenom`, `telephone`, `email` FROM `Users` WHERE `id_users` = :id";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([':id'=>$id]);
        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }
};