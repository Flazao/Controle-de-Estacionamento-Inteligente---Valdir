<?php
namespace Infra\Database;

use SQLite3;

class DatabaseConnection
{
    private static ?SQLite3 $instance = null;

    private function __construct() {}

    public static function getInstance(): SQLite3
    {
        if (self::$instance === null) {
            self::$instance = new SQLite3(__DIR__ . '/../../database/estacionamento.db');
        }
        return self::$instance;
    }
}
