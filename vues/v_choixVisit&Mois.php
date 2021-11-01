<div id="contenu">
    <h2>Validation des frais par le comptable</h2>
    <form method="POST" action="index.php?uc=suivifrais&action=voirFrais">
        <p>
            <label for="choixVisit">Choisir le nom du visiteur :</label>
                    <input list="lstVisiteur" type="text" id="choix_visiteur" name="choix_visiteur" required="required">
                    <datalist id="lstVisiteur" name="lstVisiteur">
                        <?php foreach($noms as $nom){
                                $lenom = $nom['nom'];  
                                if($lenom == $visitASelectionner){
                        ?>
                            <option selected value="<?php echo $lenom; ?>">
                        <?php
                        }
                        else{ ?>
                            <option value="<?php echo $mois; ?>">
                        <?php
                            }
                        }
                        ?>
                    </datalist>
        </p>

        <p>
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois">
            <?php
			foreach ($lesMois as $unMois)
			{
			    $mois = $unMois['mois'];
				$numAnnee =  $unMois['numAnnee'];
				$numMois =  $unMois['numMois'];
				if($mois == $moisASelectionner){
				?>
				<option selected value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
				else{ ?>
				<option value="<?php echo $mois ?>"><?php echo  $numMois."/".$numAnnee ?> </option>
				<?php 
				}
			
			}
           
		   ?>    
            
        </select>
        </p>

        <p>
            <input id="ok" type="submit" value="Valider" size="20" />
        </p>
    </form>