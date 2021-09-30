<div id="contenu">
    <h2>Validation des frais par le comptable</h2>
    <form method="POST" action="index.php?uc=suivifrais">
        <p>
            <label for="choix_bieres">Choisir le nom du visiteur :</label>
                    <input list="visiteur" type="text" id="choix_visiteur">
                    <datalist id="visiteur">
                    <option value="Villechane">
                    <option value="Cottin">
                    <option value="Bioret">
                    <option value="Bunisset">
                    <option value="Andre">
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
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler"> 
        </p>
    </form>