<div id="contenu">
    <h2>Validation des frais par le comptable</h2>
    <form method="POST" action="index.php?uc=suivifrais">
        <p>
            <label for="choixVisit">Choisir le nom du visiteur :</label>
                    <input list="visiteur" type="text" id="choix_visiteur">
                    <datalist id="visiteur">
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
        <form class="final" method="POST" action="index.php?uc=suivifrais&mois=<?php echo $mois ?>visiteur=$visiteur">
							<input class="valid" name="valide" type="submit" value="Valider">
		</form>
        </p>
    </form>