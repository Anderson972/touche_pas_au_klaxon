<?php

namespace Anderson\TouchePasAuKlaxon\Models;

use Anderson\TouchePasAuKlaxon\Core\Database;
use PDO;

class AgenceModel
{
    public function getAgencies(){
        $pdo = Database::getConnection();

        $sql = "SELECT * FROM `Agences`;";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute();
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
};