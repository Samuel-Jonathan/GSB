﻿<h3>Fiche de frais du mois <?php echo $numMois . "-" . $numAnnee ?> :
</h3>
<center>
  <div class="encadre">
    <p>
      Etat : <?php echo $libEtat ?> depuis le <?php echo $dateModif ?> <br> Montant validé : <?php echo $montantValide ?>


    </p>
    <table class="listeLegere">
      <caption style="color:black">Eléments forfaitisés </caption>
      <tr>
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
          $libelle = $unFraisForfait['libelle'];
        ?>
          <th> <?php echo $libelle ?></th>
        <?php
        }
        ?>
      </tr>
      <tr>
        <?php
        foreach ($lesFraisForfait as $unFraisForfait) {
          $quantite = $unFraisForfait['quantite'];
        ?>
          <td class="qteForfait"><?php echo $quantite ?> </td>
        <?php
        }
        ?>
      </tr>
    </table>
    <table class="listeLegere">
      <caption style="color:black">Descriptif des éléments hors forfait -<?php echo $nbJustificatifs ?> justificatifs reçus -
      </caption>
      <tr>
        <th class="date">Date</th>
        <th class="libelle">Libellé</th>
        <th class='montant'>Montant</th>
      </tr>
      <?php
      foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
        $date = $unFraisHorsForfait['date'];
        $libelle = $unFraisHorsForfait['libelle'];
        $montant = $unFraisHorsForfait['montant'];
      ?>
        <tr>
          <td><?php echo $date ?></td>
          <td><?php echo $libelle ?></td>
          <td><?php echo $montant ?></td>
        </tr>
      <?php
      }
      ?>
    </table>
  </div>
  <?php
  if ($_SESSION['role'] == 'Comptable') {
    echo '<form action="index.php?uc=etatFrais&action=validerFicheFrais" method="post">';
    echo '<input id="bouton" type="submit" name="connect" value="Validez" alt="">';
    echo '</form>';
    $_SESSION['mois'] = $numMois;
    $_SESSION['annee'] = $numAnnee;
  }
  ?>
</center>
</div>