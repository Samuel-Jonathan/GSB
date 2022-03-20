<?php
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
		$login = $_REQUEST['utilisateur'];
		$mdp = $_REQUEST['mdp'];
		$visiteur = $pdo->getInfosVisiteur($login,$mdp);
		if(!is_array( $visiteur)){
			ajouterErreur("Login ou mot de passe incorrect");
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else {
			$id = $visiteur['id'];
			$nom =  $visiteur['nom'];
			$prenom = $visiteur['prenom'];
			$role = $visiteur['role'];

			connecter($id, $nom, $prenom, $role);
			if ($role == 'Comptable') {
				include("vues/v_sommaire_comptable.php");
			} else {
				include("vues/v_sommaire.php");
			}
		}
		break;
	}
	default :{
		session_destroy();
		include("vues/v_connexion.php");
		break;
	}
}
?>