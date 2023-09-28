<?php

class PDF extends FPDF
{
    // header
    public function Header()
    {
        $user = Formation::getInstance()->findBy(['email_resp_stage' => $_SESSION['email']]);
        $user = $user[0];
        $nom = $user['nom_resp_stage'];
        $prenom = $user['prenom_resp_stage'];
        // style
        $this->SetFillColor(21, 49, 66);
        $this->SetTextColor(0);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 13);

        $title = 'Liste des étudiants - '.$nom.' '.$prenom.'  ';
        // Titre
        $this->Cell(180, 10, $title, 1, 0, 'C');
        // Saut de ligne
        $this->Ln(20);
    }

    // footer
    public function Footer()
    {
        // Positionnement 1.5cm d'en bas
        $this->SetY(-15);
        // font
        $this->SetFont('Helvetica', 'I', 8);
        // nb page
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

// Connexion bd
class dbObj
{
    private $con;

    public function connDb()
    {
        try {
            $pdo = new PDO('mysql:host='.APP_DB_HOST.';dbname='.APP_DB_NAME, APP_DB_USER, APP_DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $pdo;

            return $this->conn;
        } catch (PDOException $e) {
            exit('Connection failed: '.$e->getMessage());
        }
    }
}
try {
    /**
     * Faire les requêtes SQL.
     */
    $db = new dbObj();
    $pdo = $db->connDb();

    // récup le responsable connecté
    $id_formation = $user['id_formation'];

    // récup les données de la table étudiant en fonction de la formation, les sortir par odre
    $stmt1 = $pdo->query("SELECT nom_etudiant, email_etudiant, COUNT(p.id_etudiant) AS count
                            FROM etudiant e
                            LEFT JOIN postuler p ON e.id_etudiant = p.id_etudiant
                            LEFT JOIN formation f ON e.id_formation = f.id_formation
                            WHERE e.id_formation = '$id_formation'
                            GROUP BY e.id_etudiant
                            ORDER BY count ASC");

    // renvoie le nombre d'inscriptions par étudiant en fonction de la formation, les sortir par odre
    $stmt2 = $pdo->query("SELECT e.*, COUNT(p.id_etudiant) AS count
                            FROM etudiant e
                            LEFT JOIN postuler p ON e.id_etudiant = p.id_etudiant
                            WHERE e.id_formation = '$id_formation'
                            GROUP BY e.id_etudiant
                            ORDER BY count ASC");

    // recup le nom de la formation
    $stmt_formation = $pdo->query("SELECT nom_BUT as but 
                                    FROM formation 
                                    WHERE id_formation = '$id_formation' ");
    $formation = $stmt_formation->fetch(PDO::FETCH_ASSOC);
    $formation = $formation['but'];

    // recup l'année du BUT
    $stmt_annee_BUT = $pdo->query("SELECT annee_BUT as annee 
                                    FROM formation 
                                    WHERE id_formation = '$id_formation' ");
    $annee_BUT = $stmt_annee_BUT->fetch(PDO::FETCH_ASSOC);
    $annee_BUT = $annee_BUT['annee'];

    // recup la date de début des inscriptions
    $stmt_deb_inscr = $pdo->query("SELECT date_deb_insc as deb_insc 
                                    FROM formation 
                                    WHERE id_formation = '$id_formation' ");
    $deb_inscr = $stmt_deb_inscr->fetch(PDO::FETCH_ASSOC);
    $deb_inscr = $deb_inscr['deb_insc'];

    // recup la date de fin des inscriptions
    $stmt_fin_inscr = $pdo->query("SELECT date_fin_insc as fin_insc 
                                    FROM formation 
                                    WHERE id_formation = '$id_formation' ");
    $fin_inscr = $stmt_fin_inscr->fetch(PDO::FETCH_ASSOC);
    $fin_inscr = $fin_inscr['fin_insc'];

    // recup le max d'entretiens
    $nb_max_entretiens = $pdo->query("SELECT nb_max_entretiens as max 
                                    FROM formation 
                                    WHERE id_formation = '$id_formation' ");
    $max_entretiens = $nb_max_entretiens->fetch(PDO::FETCH_ASSOC);
    $max_entretiens = $max_entretiens['max'];

    // récupère le nombre total d'étudiants
    $stmt_total_etu = $pdo->query("SELECT COUNT(*) as total FROM etudiant e 
                                    LEFT JOIN formation f 
                                    ON e.id_formation = f.id_formation 
                                    WHERE f.id_formation = '$id_formation'");
    $total_etu = $stmt_total_etu->fetch(PDO::FETCH_ASSOC);
    $total_etu = $total_etu['total'];

    // récupère le nombre d'étudiants ayant 0
    $stmt_empty_etu = $pdo->query("SELECT COUNT(*) as zero_count
                                     FROM etudiant e LEFT JOIN formation f ON e.id_formation = f.id_formation 
                                    LEFT JOIN postuler p ON e.id_etudiant = p.id_etudiant 
                                    WHERE f.id_formation = '$id_formation'
                                    GROUP BY e.id_etudiant
                                    HAVING COUNT(p.id_etudiant) = 0");
    $empty_etu = $stmt_empty_etu->fetch(PDO::FETCH_ASSOC);
    $empty_etu = $empty_etu['zero_count'];

    if (!$stmt1 || !$stmt2 || !$annee_BUT || !$total_etu || !$empty_etu) {
        exit('Database error: '.$pdo->errorInfo()[2]);
    }

    /**
     * Fin des requêtes, générer le PDF et rentrer les données.
     */
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->AliasNbPages();

    // style de l'entête
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(21, 49, 66);
    $pdf->SetLineWidth(.3);
    $pdf->SetTextColor(255);

    // $pdf->Cell(longeur, largeur, contenu , mettre en colonne, rester sur le mm tableau, centrer (C), fill bg color (boolean));
    // $pdf->Cell(0, 10, $txt_utf , 0, 1, 'C');

    // En-têtes du tableau
    $pdf->Cell(60, 12, 'Nom étudiant(s)', 1, 0, 'C', 1);
    $pdf->Cell(60, 12, 'Email étudiant(s)', 1, 0, 'C', 1);
    $pdf->Cell(60, 12, 'Nombre inscriptions', 1, 0, 'C', 1);
    $pdf->Ln();

    // Données du tableau
    while (($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) && ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC))) {
        $pdf->setFont('Arial', '', 11);
        $pdf->SetTextColor(0);

        // je crois que ca marche pas
        $nom_etudiant_utf8 = utf8_encode($row1['email_etudiant']);

        $txt = $row1['email_etudiant'];

        $str = iconv('UTF-8', 'windows-1252', $txt);

        $pdf->Cell(60, 12, $row1['nom_etudiant'], 1, 0, 'C');
        $pdf->Cell(60, 12, $str, 1, 0, 'C');
        $pdf->Cell(60, 12, $row2['count'], 1, 0, 'C');
        $pdf->Ln();
    }

    /*
     * Affichage de stats
    */
    $pdf->Ln();

    // Calculer le pourcentage
    if ($total_etu > 0) {
        $pourcentage_zero = ($empty_etu / $total_etu) * 100;
    } else {
        $pourcentage_zero = 0;
    }
    // Afficher le pourcentage
    $pdf->MultiCell(0, 10, "Pourcentage d'étudiants en ".$formation.' et en année '.$annee_BUT." n'ayant pas postulé aux offres : ".number_format($pourcentage_zero, 2, ',', ' ').'%');
    $pdf->Cell(30, 10, 'Début des inscriptions : '.date('d/m/Y', strtotime($deb_inscr)).'');
    $pdf->Ln();
    $pdf->Cell(30, 10, 'Fin des inscriptions : '.date('d/m/Y', strtotime($fin_inscr)).'');
    $pdf->Ln();
    $pdf->Cell(0, 10, "Nombre maximum d'entretiens par étudiant : ".$max_entretiens.'');
    // Génération du PDF
    $pdf->Output();
} catch (PDOException $e) {
    exit('Connection failed: '.$e->getMessage());
}
