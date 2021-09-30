<div id="contenu">
    <h2>Validation des frais par le comptable</h2>
    <form method="POST" action="index.php?uc=suivifrais">
        <p>
            <label for="choix_bieres">Choisir le nom du visiteur :</label>
                    <input list="visiteur" type="text" id="choix_visiteur">
                    <datalist id="visiteur">
                    <?php foreach($noms as $nom){
                            $lenom = $nom['nom'];
                            
                    ?>
                    
                        <option value=<?php echo $lenom; ?>>
                    <?php
                    }
                    ?>

                    </datalist>


        </p>

        <p>
        <label for="lstMois" accesskey="n">Mois : </label>
        <select id="lstMois" name="lstMois">
            <option selected value="mois">09/21</option>  
            <option  value="mois">10/21</option>  
            <option  value="mois">11/21</option>  
            <option value="mois">12/21</option>   
        </select>
        </p>

        <p>
        <form class="final" method="POST" action="index.php?uc=suivifrais&mois=<?php echo $mois ?>visiteur=$visiteur">
							<input class="valid" name="valide" type="submit" value="Imprimer">
		</form>
        </p>
    </form>