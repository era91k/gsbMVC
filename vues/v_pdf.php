<?php
	// Connexion à la BDD (à personnaliser)
	if(!isset($_SESSION)){//Vérification des variables de session 
		session_start();
	}

	// Appel de la librairie FPDF
	require("fpdf/fpdf.php");

	// Création de la class PDF
	class PDF extends FPDF {
		// Header
		function Header() {
			// Logo : 8 >position à gauche du document (en mm), 2 >position en haut du document, 80 >largeur de l'image en mm). La hauteur est calculée automatiquement.
			$this->Image('images/logo.jpg',8,2);
			// Saut de ligne 20 mm
			$this->Ln(20);

			// Titre gras (B) police Helbetica de 11
			$this->SetFont('Helvetica','B',11);
			// fond de couleur gris (valeurs en RGB)
			$this->setFillColor(230,230,230);
			// position du coin supérieur gauche par rapport à la marge gauche (mm)
			$this->SetX(70);
			// Texte : 65 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligne ensuite, C >centrer texte, 1> couleur de fond ok  
			$this->Cell(65,8,'ETAT DES FRAIS ENGAGES',0,1,'C',1);
			// Saut de ligne 10 mm
			$this->Ln(10);    
		}
		// Footer
		function Footer() {
			// Positionnement à 1,5 cm du bas
			$this->SetY(-15);
			// Police Arial italique 8
			$this->SetFont('Helvetica','I',9);
			// Numéro de page, centré (C)
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}

	// On active la classe une fois pour toutes les pages suivantes
	// Format portrait (>P) ou paysage (>L), en mm (ou en points > pts), A4 (ou A5, etc.)
	ob_get_clean();
	$pdf = new PDF('P','mm','A4');

	// Nouvelle page A4 (incluant ici logo, titre et pied de page)
	$pdf->AddPage();
	// Polices par défaut : Helvetica taille 9
	$pdf->SetFont('Helvetica','',9);
	// Couleur par défaut : noir
	$pdf->SetTextColor(0);
	// Compteur de pages {nb}
	$pdf->AliasNbPages();

	// Sous-titre calées à gauche, texte gras (Bold), police de caractère 11
	$pdf->SetFont('Helvetica','B',11);
	// couleur de fond de la cellule : gris clair
	$pdf->setFillColor(230,230,230);
	$pdf->Cell(10,6,'Visiteur :',0,1,'C',1);
	// Cellule avec les données du sous-titre sur 2 lignes, pas de bordure mais couleur de fond grise   
	$pdf->Cell(175,6,strtoupper(utf8_decode($_SESSION['prenom'].' '.$_SESSION['nom'])),0,1,'L',1);
	$pdf->Cell(5,6,'Mois :',0,1,'C',1);
	$pdf->Cell(75,6,$numMois.'/'.$numAnnee,0,1,'L',1);
	$pdf->Ln(10); // saut de ligne 10mm

	//Fonction entête du tableau d'éléments forfaitisés
	// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
	function tete_table($position_tete) {
		global $pdf;
		$pdf->Ln(10); // saut de ligne 10mm
		$pdf->SetDrawColor(183); // Couleur du fond RVB
		$pdf->SetFillColor(221); // Couleur des filets RVB
		$pdf->SetTextColor(0); // Couleur du texte noir
		$pdf->SetY($position_tete);
		// position de colonne 1 (10mm à gauche)  
		$pdf->SetX(25);
		$pdf->Cell(45,8,utf8_decode('Libellé'),1,0,'C',1);  // 60 >largeur colonne, 8 >hauteur colonne
		// position de la colonne 2 (55 = 12.5+42.5)
		$pdf->SetX(70); 
		$pdf->Cell(70,8,utf8_decode('Quantité'),1,0,'C',1);
		// position de la colonne 3 (120 = 55+70)
		$pdf->SetX(140); 
		$pdf->Cell(40,8,utf8_decode('Montant unitaire'),1,0,'C',1);

		$pdf->Ln(); // Retour à la ligne
	}
	// AFFICHAGE EN-TÊTE DU TABLEAU
	// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
	$position_tete = 70;
	// police des caractères
	$pdf->SetFont('Helvetica','',9);
	$pdf->SetTextColor(0);
	// on affiche les en-têtes du tableau
	tete_table($position_tete);

	$position_detail = 78; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)

	foreach ($lesFraisForfait as $unFraisForfait){
		$libelle = $unFraisForfait['libelle'];
		$quantite = $unFraisForfait['quantite'];
		$montant = $unFraisForfait['montant'];
		// position abcisse de la colonne 2 (50 = 10 + 40)  
		$pdf->SetY($position_detail);
		$pdf->SetX(25); 
		$pdf->MultiCell(45,8,utf8_decode($libelle),1,'C');
		// position abcisse de la colonne 3 (90 = 50+ 40)
		$pdf->SetY($position_detail);
		$pdf->SetX(70); 
		$pdf->MultiCell(70,8,$quantite,1,'C');
		// position abcisse de la colonne 3 (90 = 50+ 40)
		$pdf->SetY($position_detail);
		$pdf->SetX(140); 
		$pdf->MultiCell(40,8,$montant,1,'C');

		// on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
		$position_detail += 8; 
	}
	$pdf->Cell(5,6,'Total :',0,1,'L',1);
	
	$pdf->Ln(); // Retour à la ligne
	// Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok  
	$pdf->Cell(190,8,'Autres Frais',0,1,'C',1);
	
	// Fonction en-tête des tableaux en 3 colonnes de largeurs variables
	function entete_table($position_entete) {
		global $pdf;
		$pdf->SetDrawColor(183); // Couleur du fond RVB
		$pdf->SetFillColor(221); // Couleur des filets RVB
		$pdf->SetTextColor(0); // Couleur du texte noir
		$pdf->SetY($position_entete); 
		// position de colonne 1 (10mm à gauche)  
		$pdf->SetX(10);
		$pdf->Cell(45,8,'Date',1,0,'C',1);  // 60 >largeur colonne, 8 >hauteur colonne
		// position de la colonne 2 (50 = 10+40)
		$pdf->SetX(55); 
		$pdf->Cell(105,8,utf8_decode('Libellé'),1,0,'C',1);
		// position de la colonne 3 (120 = 50+70)
		$pdf->SetX(160); 
		$pdf->Cell(40,8,utf8_decode('Quantité'),1,0,'C',1);

		$pdf->Ln(); // Retour à la ligne
	}
	// AFFICHAGE EN-TÊTE DU TABLEAU
	// Position ordonnée de l'entête en valeur absolue par rapport au sommet de la page (70 mm)
	$position_entete = 140;
	// police des caractères
	$pdf->SetFont('Helvetica','',9);
	$pdf->SetTextColor(0);
	// on affiche les en-têtes du tableau
	entete_table($position_entete);

	$position_detail = 148; // Position ordonnée = $position_entete+hauteur de la cellule d'en-tête (60+8)

	foreach ($lesFraisHorsForfait as $unFraisHorsForfait){
		$date = $unFraisHorsForfait['date'];
		$libelle = $unFraisHorsForfait['libelle'];
		$montant = $unFraisHorsForfait['montant'];	
	  // position abcisse de la colonne 1 (10mm du bord)
	  $pdf->SetY($position_detail);
	  $pdf->SetX(10);
	  $pdf->MultiCell(45,8,utf8_decode($date),1,'C');
		// position abcisse de la colonne 2 (50 = 10 + 40)  
	  $pdf->SetY($position_detail);
	  $pdf->SetX(55); 
	  $pdf->MultiCell(105,8,utf8_decode($libelle),1,'C');
	  // position abcisse de la colonne 3 (90 = 50+ 40)
	  $pdf->SetY($position_detail);
	  $pdf->SetX(160); 
	  $pdf->MultiCell(40,8,$montant,1,'C');

	  // on incrémente la position ordonnée de la ligne suivante (+8mm = hauteur des cellules)  
	  $position_detail += 8; 
	}
	
	$pdf->Ln(); // Retour à la ligne
	$pdf->Ln(); // Retour à la ligne
	$pdf->Ln(); // Retour à la ligne
	$pdf->Ln(); // Retour à la ligne
	// Texte : 60 >largeur ligne, 8 >hauteur ligne. Premier 0 >pas de bordure, 1 >retour à la ligneensuite, C >centrer texte, 1> couleur de fond ok  
	$pdf->Cell(300,8,'Signature :',0,1,'C',1);

	// affichage à l'écran...
	$pdf->Output('vues/v_pdf.pdf','I');

?>