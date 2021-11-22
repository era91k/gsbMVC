<?php
	$idVisiteur = $_SESSION['idVisiteur'];
	if(isset($_POST['valide'])){
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$moisChoisi);
		$lesFraisForfait = $pdo->getLesFraisForfait2($idVisiteur,$moisChoisi);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$moisChoisi);
		$numAnnee = substr($moisChoisi,0,4);
		$numMois = substr($moisChoisi,4,2);
		include('vues/v_pdf.php');
	}
?>