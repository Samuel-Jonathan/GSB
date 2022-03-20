<?php

$action = $_REQUEST['action'];
if ($_SESSION['role'] == 'Visiteur') {
	$idVisiteur = $_SESSION['idVisiteur'];
	include("vues/v_sommaire.php");
}else{
	include("vues/v_sommaire_comptable.php");
}

switch ($action) {
	case 'selectionnerMois': {

		// Valider fiche de mois
			if ($_SESSION['role'] == 'Comptable') {
				if (isset($_REQUEST['lstVisiteurs'])) {
					$nom_prenom = $_POST['lstVisiteurs'];
					$nom_prenom = explode(' ', $nom_prenom);
					$idVisiteur = $pdo->getVisiteursID($nom_prenom[0], $nom_prenom[1]);

					$idVisiteur = $idVisiteur[0];
				}


				if(isset($idVisiteur)){
					$_SESSION['idVisiteurChoisi'] = $idVisiteur;
				}
		

				// Suivre paiement fiche de mois
			    $idVisiteur = $_SESSION['idVisiteur'];
			}



			$lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
			// Afin de sélectionner par défaut le dernier mois dans la zone de liste
			// on demande toutes les clés, et on prend la première,
			// les mois étant triés décroissants
			$lesCles = array_keys($lesMois);
			$moisASelectionner = $lesCles[0];
			include("vues/v_listeMois.php");
			break;
		}
	case 'voirEtatFrais': {


			if ($_SESSION['role'] == 'Comptable') {
				$idVisiteur = $_SESSION['idVisiteurChoisi'];
			}

			$leMois = $_REQUEST['lstMois'];
			$lesMois = $pdo->getLesMoisDisponibles($idVisiteur);
			$moisASelectionner = $leMois;
			include("vues/v_listeMois.php");
			$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
			$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
			$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
			$numAnnee = substr($leMois, 0, 4);
			$numMois = substr($leMois, 4, 2);
			$libEtat = $lesInfosFicheFrais['libEtat'];
			$montantValide = $lesInfosFicheFrais['montantValide'];
			$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
			$dateModif =  $lesInfosFicheFrais['dateModif'];
			$dateModif =  dateAnglaisVersFrancais($dateModif);
			include("vues/v_etatFrais.php");
			break;
		}

	case 'validerFicheFrais': {

			if (date('d') >= 10 && date('d') <= 15) {
				$pdo->valideFicheFrais($_SESSION["idVisiteurChoisi"], $_SESSION['annee'] . $_SESSION['mois']);
				echo 'La fiche de frais a été validé !';
			}else{
				echo "<center><p style=\"color:red; font-size:25px;\">Erreur, vous pouvez valider une fiche de frais seulement entre le 10 et le 20 d'un mois !</p></center>";
			}
		}
}
