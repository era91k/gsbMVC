<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_REQUEST['idVisiteur'];
$leMois = $_REQUEST['mois'];
$numAnnee =substr( $leMois,0,4);
$numMois =substr( $leMois,4,2);
switch($action){
	case 'majFraisForfait':{
		$lesFrais = $_REQUEST['lesFrais'];
		if(lesQteFraisValides($lesFrais)){
	  	 	$pdo->majFraisForfait($idVisiteur,$leMois,$lesFrais);
			ajouterNotif("Les valeurs des frais forfaits ont bien été mises à jours");
			include("vues/v_notifs.php");
		}
		else{
			ajouterErreur("Les valeurs des frais doivent être numériques");
			include("vues/v_erreurs.php");
		}
	  break;
	}
	case 'supprimerFrais':{
		$idFrais = $_REQUEST['idFrais'];
	    $pdo->supprimerFraisHorsForfait($idFrais);
		break;
	}
}

$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur,$leMois);
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
$leVisiteur = $pdo->getNomVisiteurById($idVisiteur);
$noms = $pdo->getNomVisiteur();
$lesClesVisit = array_keys($noms);
$visitASelectionner = $lesClesVisit[0];
$lesMois = $pdo->getLesMois();
$lesCles = array_keys($lesMois);
$moisASelectionner = $lesCles[0];
include("vues/v_choixVisit&Mois.php");
include("vues/v_tabFraisComptable.php");

?>