<?php
session_start();
require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
    function Header()
    {
        // Datum

        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, "Author: " . $_SESSION['vorname'] . ' ' . $_SESSION['nachname'], 0, 0, 'L'); // Ausgabe als Zelle für eine Tabelle ohne Rahmen änderst Du FALSE in TRUE hast du einen Rahmen

        $timestamp = date("d.m.Y", time());
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 5, "Veroeffentlicht am " . $timestamp . "", 0, 1, 'R'); // Ausgabe als Zelle für eine Tabelle ohne Rahmen änderst Du FALSE in TRUE hast du einen Rahmen
        //Title
        $this->SetFont('Arial', '', 18);
        $this->Cell(0, 6, 'Mitarbeiterstatistik', 0, 1, 'C');
        $this->Ln(10);

        //Ensure table header is output
        parent::Header();
    }

    function date($date)
    {
        $this->date = $date;
    }
}

function umlaute_ersetzen($text)
{
    $such_array = array('/&auml;/', 'ö', '&uuml;', 'ß');
    $ersetzen_array = array('ä', 'oe', 'ue', 'ss');
    $neuer_text = str_replace($such_array, $ersetzen_array, $text);
    return $neuer_text;
}

$option = $_POST['taskOption'];
if ($option = "monatlich") {

}
//Connect to database
mysql_connect('wi-projectdb.technikum-wien.at', 'ss14-bvz2-fst-2', 'DbPass4BVZ2-2');
mysql_select_db('ss14-bvz2-fst-2');
$pdf = new PDF();

$pdf->AddPage();

//first table: specify 3 columns
$pdf->AddCol('idMitarbeiter', 10, 'id', 'R');
$pdf->AddCol('nachname', 30, '', 'C');
$pdf->AddCol('vorname', 30, 'Vorname');
$pdf->AddCol('abteilung', 40, 'Abteilung');
$pdf->Table('select idMitarbeiter,username,email,vorname, nachname, telefonnummer,abteilung from mitarbeiter order by abteilung');


$pdf->Output();

?>
