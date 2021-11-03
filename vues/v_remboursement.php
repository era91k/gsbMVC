<div id="contenu">
<?php
    foreach($lesFiches as $uneFiche){
        $idVisiteur = $uneFiche['idVisiteur'];
        $mois = $uneFiche['mois'];
        $nbJustificatifs = $uneFiche['nbJustificatifs'];
        $montantValide = $uneFiche['montantValide'];
        $dateModif = $uneFiche['dateModif'];
        $etat = $uneFiche['libEtat'];
        $numFiche = $idVisiteur.$mois;

        $nomVisiteur = $pdo->getNomVisiteurById($idVisiteur);
        $numAnnee =substr( $mois,0,4);
        $numMois =substr( $mois,4,2);
?>
<form method="POST" action="index.php?uc=gererFraisComptable&action=majRembFicheFrais&idVisiteur=<?php echo $idVisiteur; ?>&mois=<?php echo $mois; ?>&etat=RB"> 
<table class="listeLegere">
    <tr>
        <th colspan="7">Fiche de frais n°<?php echo $numFiche; ?>  de <?php echo $nomVisiteur; ?></th>
    </tr>
    <tr>
        <td>Identifiant Visiteur</td>
        <td>Mois</td>
        <td>Nombre de justificatifs</td>
        <td>Montant Validé</td>
        <td>Dernière modification</td>
        <td>Etat</td>
        <td>Action</td>
    </tr>
    <tr>
        <td><?php echo $idVisiteur; ?></td>
        <td><?php echo $numMois."-".$numAnnee; ?></td>
        <td><?php echo $nbJustificatifs; ?></td>
        <td><?php echo $montantValide; ?>€</td>
        <td><?php echo $dateModif; ?></td>
        <td><?php echo $etat; ?></td>
        <td><input id="ok" type="submit" value="Rembourser" size="10" /></td>
    </tr>
</table>
    </br>
<?php
    }
?>