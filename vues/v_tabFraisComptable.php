  <?php
    $test = count($lesFraisForfait);
    $test2 = count($lesFraisHorsForfait);
    if($test == 4 or $test2 >=1 ){
      $stotal = 0;
      $stotal2 = 0;
      $total = 0;
  ?>
   <h2> Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> de <?php echo $leVisiteur ?></h2>
    </br>
  <?php
      if($test==4){
  ?>
  <form method="POST"  action="index.php?uc=gererFraisComptable&action=majFraisForfait&idVisiteur=<?php echo $idVisiteur; ?>&mois=<?php echo $leMois; ?>">
    <div class="corpsForm" style="border:none;">
      <fieldset>
        <legend>Eléments forfaitisés </legend>
        <?php
          foreach ($lesFraisForfait as $unFrais){
            $idFrais = $unFrais['idfrais'];
            $libelle = $unFrais['libelle'];
            $quantite = $unFrais['quantite'];
            $montant = $pdo->getMontantFraisForfait($idFrais);
            $result = $quantite * $montant;
            $stotal = $stotal + $result; 
        ?>
          <p>
          <label for="idFrais"><?php echo $libelle ?></label>
          <input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" size="10" maxlength="5" value="<?php echo $quantite?>" > - <?php echo $result; ?>€
          </p>
        <?php
          }
        ?>
        <h3>Total éléments forfaitisés : <?php echo $stotal; ?>€</h3>
      </fieldset>
    </div>
    <div class="piedForm">

      <p>
        <input id="ok" type="submit" value="Mettre à jour" size="20" />
      </p> 
    </div>
  </form>
        </br>
  <?php
  }else{
  ?>
    <p> Pas de ligne de frais au forfait pour cet utilisateur à ce mois </p>
  <?php
  }
  if($test2 >= 1){
  ?>
    <table class="listeLegere">
      <caption><b>Eléments hors forfait :</b></caption>
      <tr>
        <th class="date">Date</th>
        <th class="libelle">Libellé</th>
        <th class='montant'>Montant</th>
        <th class='situation'>Action</th>               
      </tr>
      <?php      
        foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) {
          $idFrais = $unFraisHorsForfait['id'];
          $date = $unFraisHorsForfait['date'];
          $libelle = $unFraisHorsForfait['libelle'];
          $montant = $unFraisHorsForfait['montant'];
          if(stristr($libelle,"REFUSE-") == false){
            $stotal2 = $stotal2 + $montant;
          }
         
      ?>
      <tr>
        <td><?php echo $date ?></td>
        <td><?php echo $libelle ?></td>
        <td><?php echo $montant ?>€</td>
        <td>
        <?php
            if(!$pdo->etatFraisHorsForfait($idFrais)){
        ?>
        <a href="index.php?uc=gererFraisComptable&action=supprimerFrais&idFrais=<?php echo $idFrais; ?>&idVisiteur=<?php echo $idVisiteur; ?>&mois=<?php echo $leMois; ?>" onclick="return confirm('Voulez-vous vraiment refuser ce frais ?');">Refuser</a>
        <?php
            }
        ?>
        </td>
      </tr>
      <?php 
        }
        $total = $stotal + $stotal2;
      ?>
      <tr>
        <td colspan="2">Total des éléments hors forfaits validés : </td>
        <td colspan="2"><?php echo $stotal2; ?>€</td>
      </tr>
    </table>
      </br>
    <h2>Le montant total la fiche est de : <?php echo $total; ?>€.</h2>
      </br>
  <?php
  }else{
  ?>
  <p> Pas de ligne de frais hors forfait pour cet utilisateur à ce mois </p>
  <?php
  }
  ?>
  <form method=POST action="index.php?uc=gererFraisComptable&action=majValFicheFrais&idVisiteur=<?php echo $idVisiteur; ?>&mois=<?php echo $leMois; ?>&montant=<?php echo $total ?>">
    <input id="ok" type="submit" value="Valider la fiche" size="20" />
  </form> 
  <?php
  }else{
    echo "Pas de fiche de frais pour cet utilisateur à ce mois";
  }
  ?>