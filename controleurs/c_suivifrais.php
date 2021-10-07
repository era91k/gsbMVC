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
}
?>