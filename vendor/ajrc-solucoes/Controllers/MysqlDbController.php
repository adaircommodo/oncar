<?php

namespace Ajrc\Controllers;

class MysqlDbController
{

    public static function Query(string $query, array $bindParams=[])
    {
    
        return \Ajrc\Models\Database::QUERY($query, $bindParams);
    
    }


    public static function Binder(array $bind, int $tipo): array
    {

        return \Ajrc\Models\Database::Binder($bind, $tipo);
    
    }
}