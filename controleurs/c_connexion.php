<?php
$unMois = getMois(date("d/m/Y"));
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array( $visiteur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else{
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
			$role = $visiteur['role'];
			connecter($id,$nom,$prenom,$role);
			include("vues/v_sommaire.php");
			if($role == "comptable"){
				$unMois = getMois(date("d/m/Y"));
				if($pdo->compteFicheNonCL($unMois) >= 1){
					$pdo->ficheCRtoCL($unMois);
				}
			}
		}
		break;
	}

	case 'deconnexion' :{
		$_SESSION = array();
		session_destroy();
		unset($_SESSION);
		ajouterErreur("Vous vous êtes déconnectés.");
		include("vues/v_erreurs.php");
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>