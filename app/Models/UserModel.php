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
};