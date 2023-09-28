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

    public function findByFormation(int $formation): array
    {
        $sql = "SELECT DISTINCT e.* FROM `{$this->tableName}` e
        INNER JOIN offre o ON e.id_entreprise = o.id_entreprise
        WHERE o.id_formation = :formation";

        return $this->query($sql, [':formation' => $formation])->fetchAll();
    }
}
