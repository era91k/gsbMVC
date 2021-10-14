<h2> Fiche de frais du mois <?php echo $numMois."-".$numAnnee?> de <?php echo $leVisiteur ?></h2>
<?php
$test = count($lesFraisForfait);
$test2 = count($lesFraisHorsForfait);
?>
<table class="listeLegere">
    <?php
        if($test==4){
    ?>
    <caption>Eléments forfaitisés </caption>
    <tr>
        <?php
        foreach ( $lesFraisForfait as $unFraisForfait ) 
        {
        $libelle = $unFraisForfait['libelle'];
    ?>	
        <th> <?php echo $libelle?></th>
        <?php
    }
    ?>
        <th>Situation</th>
    </tr>
    <tr>
    <?php
        foreach (  $lesFraisForfait as $unFraisForfait  ) 
        {
            $quantite = $unFraisForfait['quantite'];
    ?>
            <td class="qteForfait"><?php echo $quantite?> </td>
        <?php
        }
    ?>
        <td class="qteForfait">Vide</td>
    </tr>
    <?php
        }else{
    ?>
        <p> Pas de ligne de frais au forfait pour cet utilisateur à ce mois </p>
    <?php
        }
    ?>
</table>
<table class="listeLegere">
    <?php
        if($test2 >= 1){
    ?>
  	   <caption>Descriptif des éléments hors forfait :</caption>
             <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
                <th class='situation'>Situation</th>               
             </tr>
        <?php      
          foreach ( $lesFraisHorsForfait as $unFraisHorsForfait ) 
		  {
			$date = $unFraisHorsForfait['date'];
			$libelle = $unFraisHorsForfait['libelle'];
			$montant = $unFraisHorsForfait['montant'];
		?>
             <tr>
                <td><?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?></td>
                <td>Vide</td>
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