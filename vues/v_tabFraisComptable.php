<h3> Frais au forfait </h3>
<table class="listeLegere">
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
    </tr>
</table>