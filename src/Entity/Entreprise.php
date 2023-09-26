<?php

class Entreprise extends Model
{
    protected $tableName = APP_TABLE_PREFIX.'entreprise';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
