<?php

class Etudiant extends Model
{
    protected $tableName = APP_TABLE_PREFIX . 'etudiant';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    function getEtudiantsTries(int $id_formation): array
    {
        // $pdo = new PDO('mysql:host=localhost;dbname=sae_s5', 'root', '');

        $sql = "SELECT e.*, COUNT(p.id_etudiant) AS nombre_de_fois
        FROM `{$this->tableName}` e
        LEFT JOIN postuler p ON e.id_etudiant = p.id_etudiant
        WHERE e.id_formation = :id_formation
        GROUP BY e.id_etudiant
        ORDER BY nombre_de_fois ASC";


        // $stmt = $pdo->prepare($sql);
        // $stmt->bindValue(':id_formation', $id_formation, PDO::PARAM_INT);
        // $stmt->execute();
        // $etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->query($sql, [':id_formation' => $id_formation])->fetchAll();
    }
}
