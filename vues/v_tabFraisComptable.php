<h2> Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> de <?php echo $leVisiteur ?></h2>
<?php
$test = count($lesFraisForfait);
$test2 = count($lesFraisHorsForfait);
?>
    <?php
        if($test==4){
    ?>
      <form method="POST"  action="index.php?uc=gererFraisComptable&action=majFraisForfait&idVisiteur=<?php echo $idVisiteur; ?>&mois=<?php echo $leMois; ?>">
      <div class="corpsForm">
          
          <fieldset>
            <legend>Eléments forfaitisés
            </legend>
			<?php
				foreach ($lesFraisForfait as $unFrais)
				{
					$idFrais = $unFrais['idfrais'];
					$libelle = $unFrais['libelle'];
					$quantite = $unFrais['quantite'];
			?>
					<p>
						<label for="idFrais"><?php echo $libelle ?></label>
						<input type="text" id="idFrais" name="lesFrais[<?php echo $idFrais?>]" size="10" maxlength="5" value="<?php echo $quantite?>" >
					</p>
			
			<?php
				}
			?>
          </fieldset>
      </div>
      <div class="piedForm">
      <p>
        <input id="ok" type="submit" value="Mettre à jour" size="20" />
      </p> 
      </div>
        
      </form>
    <?php
        }else{
    ?>
        <p> Pas de ligne de frais au forfait pour cet utilisateur à ce mois </p>
    <?php
        }
    ?>
<table class="listeLegere">
    <?php
        if($test2 >= 1){
    ?>
  	   <caption>Descriptif des éléments hors forfait :</caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
                <th class='situation'>Action</th>               
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
      $idFrais = $unFraisHorsForfait['id'];
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
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
        }else{
        ?>
        <p> Pas de ligne de frais hors forfait pour cet utilisateur à ce mois </p>
        <?php
        }
		?>
    </table>