<?php 
$_SESSION['site'] = array('dashboard','Ust-Voranmeldung');
$pdfname="U30";
echo '<iframe src="images/'. $pdfname .'.pdf#pagemode=none&toolbar=0&scrollbar=0&statusbar=0&navpanes=0" width="1000" height="600" frameborder="0"></iframe>';  

?>