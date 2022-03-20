<h2>Identification utilisateur</h2>

<!-- Logo des champs -->
<img id="utilisateur_icone" src="./images/user.png" alt="">
<img id="mdp_icone" src="./images/password.png" alt="">
<!-- Formulaire de connexion -->
<form method="POST" action="index.php?uc=connexion&action=valideConnexion">
      <input id="utilisateur" type="text" name="utilisateur">
      <input id="mdp" type="password" name="mdp">
      <input id="connecte" type="submit" value="Se connecter" name="valider">
      <input id="effacer" type="reset" value="Annuler" name="annuler">
</form>