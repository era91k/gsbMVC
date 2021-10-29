<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
switch($action){
    case 'selectionnerVisiteurEtMois':{
        $noms = $pdo->getNomVisiteur();
        $lesClesVisit = array_keys($noms);
        $visitASelectionner = $lesClesVisit[0];
        
        $lesMois = $pdo->getLesMois();
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        include("vues/v_choixVisit&Mois.php");
        break;
    }

    case 'voirFrais':{
        $noms = $pdo->getNomVisiteur();
        $lesClesVisit = array_keys($noms);
        $visitASelectionner = $lesClesVisit[0];
        $lesMois = $pdo->getLesMois();
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];
        include("vues/v_choixVisit&Mois.php");
        $leVisiteur = $_REQUEST['choix_visiteur'];
        $leMois = $_REQUEST['lstMois'];
        $idVisiteur = $pdo->getIdVisiteur($leVisiteur);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur,$leMois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
        $numAnnee =substr( $leMois,0,4);
		$numMois =substr( $leMois,4,2);
        include("vues/v_tabFraisComptable.php");
    }

}
?>