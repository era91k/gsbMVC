<?php
$idVisiteur = $_SESSION['idVisiteur'];
if(isset($_POST['valide'])){
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$moisChoisi);
	include('vues/v_pdf.php');
}
?>