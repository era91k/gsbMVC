 <!-- Division pour le sommaire -->
 <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>
        <?php 
            if($_SESSION['role'] == 'visiteur'){
        ?>
            <ul id="menuList">
                <li >
                    <?php echo $_SESSION['role']; ?> : <br>
                    <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
                </li>
            <li class="smenu">
                <a href="index.php?uc=gererFrais&action=saisirFrais" title="Saisie fiche de frais ">Saisie fiche de frais</a>
            </li>
            <li class="smenu">
                <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes fiches de frais</a>
            </li>
        <li class="smenu">
                <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
            </li>
            </ul>
        <?php
            }
            else{
        ?>
            <ul id="menuList">
                <li >
                    <?php echo $_SESSION['role']; ?> : <br>
                    <?php echo $_SESSION['prenom']."  ".$_SESSION['nom']  ?>
                </li>
            <li class="smenu">
                <a href="index.php?uc=suivifrais" title="Saisie fiche de frais ">Valider/Refuser fiche de frais</a>
            </li>
            <li class="smenu">
                <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Suivre paiement fiche de frais</a>
            </li>
        <li class="smenu">
                <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
            </li>
            </ul>
        <?php
            }
        ?>
    </div>
    