<?php

$_SESSION['site'] = array('dashboard');

echo '<div id="dashboard">';
//
//	if ($_SESSION['rolle'] == "Verkauf") {
//		echo '<div class="left">
//			<figure class="dashboardauswahl">
//				<a href="index.php?section=artikel">
//					<img src="images/artikel.jpg" alt="Artikel">
//					<figcaption>Artikel</figcaption>
//				</a>
//			</figure>
//			</div>
//			<div class="left">
//				<figure class="dashboardauswahl">
//					<a class="green" href="index.php?section=angebote">
//						<img src="images/angebote.jpg" alt="Angebote">
//						<figcaption>Angebote</figcaption>
//					</a>
//				</figure>
//			</div>
//			<div class="left">
//				<figure class="dashboardauswahl">
//					<a class="yellow" href="index.php?section=auftraege">
//						<img src="images/auftraege.jpg" alt="Auftrage">
//						<figcaption>Auftraege</figcaption>
//					</a>
//				</figure>
//			</div>
//			<div class="left">
//				<figure class="dashboardauswahl">
//					<a class="red" href="index.php?section=rechnungen">
//						<img src="images/rechnungen.jpg" alt="Rechnungen">
//						<figcaption>Rechnungen</figcaption>
//					</a>
//				</figure>
//			</div>';
//	}
//
echo '<div class="left">

			<figure class="dashboardauswahl">

				<a href="../../index.php?section=artikel">
					<img src="public/images/artikel.jpg" alt="Artikel">
					<figcaption>Artikel</figcaption>
				</a>
			</figure>
			</div>
			<div class="left">
				<figure class="dashboardauswahl">
					<a class="green" href="../../index.php?section=angebote">
						<img src="public/images/angebote.jpg" alt="Angebote">
						<figcaption>Angebote</figcaption>
					</a>
				</figure>
			</div>
			<div class="left">
				<figure class="dashboardauswahl">
					<a class="yellow" href="../../index.php?section=auftraege">
						<img src="public/images/auftraege.jpg" alt="Auftrage">
						<figcaption>Auftraege</figcaption>
					</a>
				</figure>
			</div>
			<div class="left">
				<figure class="dashboardauswahl">
					<a class="red" href="../../index.php?section=rechnungen">
						<img src="public/images/rechnungen.jpg" alt="Rechnungen">
						<figcaption>Rechnungen</figcaption>
					</a>
				</figure>
			</div>
			<div class="left clear">
				<figure class="dashboardauswahl">
					<a href="../../index.php?section=USt">
						<img src="../../public/images/Umsatzsteuer.png" alt="Umsatzsteuer">
						<figcaption>USt-Voranmeldung</figcaption>
					</a>
				</figure>
			</div>
			<div class="left">
				<figure class="dashboardauswahl">
					<a href="#">
						<img src="../../public/images/kunden.png" alt="Kunden">
						<figcaption>Kunden</figcaption>
					</a>
				</figure>
			</div>
			<div class="left">
				<figure class="dashboardauswahl">
					<a href="#">
						<img src="../../public/images/kundenanfragen.png" alt="Kundenanfragen">
						<figcaption>Kundenanfragen</figcaption>
					</a>
				</figure>
			</div>
                <div class="left">
				<figure class="dashboardauswahl">
					<a href="#">
						<img src="../../public/images/feedback.png" alt="Feedback">
						<figcaption>Feedback</figcaption>
					</a>
				</figure>
                </div>
                  <div class="left">
				<figure class="dashboardauswahl">
					<a href="../../index.php?section=Personalreporting">
						<img src="../../public/images/feedback.png" alt="Personalreporting">
						<figcaption>Personalreporting</figcaption>
					</a>
				</figure>
                </div>



			</div>';
echo '<div class=left style= text-align:center;margin-top:100px;margin-left:1000px;><a href=../../fpdf17/FAQ.htm>FAQ | Impressium</a></div>';
echo '</div>';
?>