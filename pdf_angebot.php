<?php
$_SESSION['site'] = array('dashboard', 'angebote');
require('fpdf17/fpdf.php');

class PDF extends FPDF {

	function Header() {
		//UnderConstruction
		$this->Image('images/pdf_logo.png',10,5,25);
		$this->SetFont('Arial','B',13);
		$this->Cell(191,7,'Felix Martin Hi-Fi und Videostudios',0,1,R);
		$this->SetFont('Arial','',11);
		$this->Cell(191,5,'Neubaugasse 7/1/3',0,1,R);
		$this->Cell(191,5,'A-1060 Wien',0,1,R);
		$this->ln(3);
		$this->Line(10,32,200,32);
		$this->ln(20);
   	}

 	function Footer() {
 		//UnderConstruction
 		$this->SetY(-22);
 		$this->Line(10,277,200,277);

 		$this->SetXY(200,-18);
 		$this->SetFont('Arial','',8);
		$this->Cell(1,3,'Tel.: +43 1 330 15',0,2,R);
		$this->Cell(1,3,'e-Mail: office@martin-hifi.at',0,2,R);
		$this->Cell(1,3,'www.martin-hifi.at',0,2,R);
 	}

 	function LoadData($file) {
 		//für ArtikelTabelle
 		$lines = file($file);
 		$data = array();
 		foreach($lines as $line);
 			$data[] = explode(";",trim($line));
 		return $data;
 	}

 	function Kunde($row) {
 		$this->SetXY(20, 52);
 		$this->SetFont('Arial','',13);
		$this->Cell(1,5,$row['Anrede'],0,2,L);
		if ($kunde['Anrede']!='Firma') {
			$this->Cell(1,5,$row['Vorname'] . ' ' . $row['Nachname'],0,2,L);
		} else {
			$this->Cell(1,5,$row['Firma'],0,2,L);
		}
		$this->Cell(1,5,$row['Strasse'],0,2,L);
		$this->Cell(1,5,$row['PLZ'] . ' ' . $row['Ort'],0,2,L);
		$this->Cell(1,5,$row['USTIDNR'],0,2,L);
 	}

 	function Status($row) {
 		$this->SetXY(160, 52);
 		$this->SetFont('Arial','B',11);
 		$this->Cell(1,5,'Angebot Nr.:',0,2,R);
		$this->SetFont('Arial','',11);
 		$this->Cell(2,5,'Kunden Nr.: ',0,2,R);
 		$this->Cell(2,5,'Mitarbeiter Nr.: ',0,2,R);
 		$this->Cell(2,10,'Datum: ',0,2,R);
 		
 		$this->SetXY(190, 52);
 		$this->SetFont('Arial','B',11);
 		$this->Cell(1,5,$row['ID'],0,2,R);
 		$this->SetFont('Arial','',11);
 		$this->Cell(1,5,$row['KundeID'],0,2,R);
 		$this->Cell(1,5,$row['MitarbeiterID'],0,2,R);
 		$this->Cell(1,10,$row['Datum'],0,2,R);
 	}

 	function Betreff($row) {
 		//UnderConstruction
 		$this->SetXY(20,100);
 		$this->SetFont('Arial','B',15);
 		$this->Cell(10,5,'Angebot',0,2,L);
 		$this->ln(10);

 	}

 	function Artikel($artikel, $queryArtikel) {
 		$this->SetXY(30,130);
 		$this->SetFont('Arial','',11);
 		    for ($i=0; $i < mysql_num_rows ($queryArtikel); $i++) { 
 		$this->Cell(15,5,$artikel[$i]['ArtikelID'],0,0,L);
 		$this->Cell(90,5,$artikel[$i]['Artikelname'],0,0,L);
 		$this->Cell(20,5,$artikel[$i]['Menge'],0,0,R);
 		$this->Cell(20,5,$artikel[$i]['Preis'],0,1,R);
 		$this->SetLeftMargin(30);
 		}
 	}

 	function ArtikelTabelle($header, $data) {
		// Colors, line width and bold font
  	 	$this->SetFillColor(255,0,0);
    	$this->SetTextColor(255);
    	//$this->SetDrawColor(128,0,0);
    	$this->SetLineWidth(.3);
    	$this->SetFont('','B');
    	// Header
    	$w = array(40, 35, 40, 45);
    	for($i=0;$i<count($header);$i++)
        	$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    		$this->Ln();
    		// Color and font restoration
    		$this->SetFillColor(224,235,255);
    		$this->SetTextColor(0);
    		$this->SetFont('');
    		// Data
    		$fill = false;
    	foreach($data as $row) {
        	$this->Cell($w[0],6,$row[0],'LR',0,'L',$fill);
        	$this->Cell($w[1],6,$row[1],'LR',0,'L',$fill);
        	$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        	$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        	$this->Ln();
        	$fill = !$fill;
    	}
    // Closing line
    	$this->Cell(array_sum($w),0,'','T');
	}

 	function Info() {
 		//UnderConstruction
 	}
}
	
	ConnectMySql();

	function ConnectMySql() {
		if (isset($_POST['erstellePDF'])) {
			$con = mysql_connect("wi-projectdb.technikum-wien.at:3306", "SS13-BVZ2-FST-3", "DbPass4BVZ2-3");
    		mysql_select_db("ss13-bvz2-fst-3");
 			$query = mysql_query("select * FROM angebotartikel ang
				LEFT JOIN Angebot on ang.AngebotID=Angebot.ID
				LEFT JOIN Mitarbeiter on Angebot.MitarbeiterID=Mitarbeiter.ID
				LEFT JOIN Kunde on Angebot.KundeID=Kunde.ID
				LEFT JOIN Adresse on Kunde.Adresse=Adresse.ID
				WHERE ang.AngebotID=" . $_POST['erstellePDF']);
 			$queryArtikel = mysql_query("select AngebotID, ArtikelID, Artikelname, Preis, Menge FROM angebotartikel 
				WHERE AngebotID=" . $_POST['erstellePDF']);
 			$row = mysql_fetch_array($query);
 		    
 		    for ($i=0; $i < mysql_num_rows ($queryArtikel); $i++) { 
            	$artikel[$i] = mysql_fetch_array($queryArtikel);
            }

 			createPDF($row, $artikel, $queryArtikel);
 		} else {
 			header ('index.php?section=angebote');
 			exit;
 		}
 	}

 function CreatePDF($row, $artikel, $queryArtikel) {
	$pdf = new PDF('P','mm','A4');
	//$data = $pdf->LoadData($file);
	$pdf->AliasNbPages();
	$pdf->AddPage();
	if ($row['KundeID']!=null) {
		$pdf->Kunde($row);
	}
	$pdf->Status($row);
	$pdf->Betreff($row);
	$pdf->Artikel($artikel, $queryArtikel);
	//$pdf->ArtikelTabelle();
	//$pdf->Info();
	$pdf->SetFont('Arial','',11);
	$pdf->Output('Rechnung.pdf',I);
}

?>