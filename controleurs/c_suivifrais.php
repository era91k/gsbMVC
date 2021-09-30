<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
switch($action){
	case 'rechercheFicheFrais':{
		if($pdo->estPremierFraisMois($idVisiteur,$mois)){
			$pdo->creeNouvellesLignesFrais($idVisiteur,$mois);
		}
		break;
	}
}




include("vues/v_choixVisit&Mois.php");

?>