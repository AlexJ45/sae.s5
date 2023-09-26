<?php

class Postuler extends Model
{
    protected $tableName = APP_TABLE_PREFIX.'postuler';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
