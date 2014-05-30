<?php 
$_SESSION['site'] = array('dashboard','Ust-Voranmeldung');
$pdfname="U30";
echo '<iframe src="images/'. $pdfname .'.pdf#pagemode=none&toolbar=0&scrollbar=0&statusbar=0&navpanes=0" id="ust" frameborder="0"></iframe>';

?>