<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/conf.inc.php');
require_once(__ROOT__.'/inc/header.inc.php');
require_once(__ROOT__.'/inc/contact.action.inc.php');
?> 

<h2 class="content-subhead">Formulaire de contact</h2>
<form class="pure-form pure-form-aligned" method="POST" action="<?php if(isset($_GET['id'])) { echo $path.'/index.php?action=update&id='.$_GET['id']; } else { echo $path.'/index.php?action=add'; } ?>">
    <fieldset>
        <div class="pure-control-group">
            <label for="entreprise">Entreprise</label>
            <input name="entreprise" id="entreprise" type="text" placeholder="Acme" value="<?php echo $donnees['entreprise']; ?>">
        </div>

        <div class="pure-control-group">
            <label for="name">Nom</label>
            <input name="name" id="name" type="text" placeholder="John Johnson" value="<?php echo $donnees['name']; ?>">
        </div>

        <div class="pure-control-group">
            <label for="poste">Poste</label>
            <input name="poste" id="poste" type="text" placeholder="Developper" value="<?php echo $donnees['poste']; ?>">
        </div>

        <div class="pure-control-group">
            <label for="email">Email</label>
            <input name="email" id="email" type="email" placeholder="john.johnson@acme.tld" value="<?php echo $donnees['email']; ?>" ">
        </div>
        
        <div class="pure-control-group">
            <label for="phone">Telephone</label>
            <input name="phone" id="phone" type="tel" placeholder="0102030405" value="<?php echo $donnees['phone']; ?>">
        </div>

        <div class="pure-control-group">
            <label for="1place">Lieu de rencontre</label>
            <input name="1place" id="1place" type="text" placeholder="Palo Alto" value="<?php echo $donnees['1place']; ?>">
        </div>
        
        <div class="pure-control-group">
            <label for="1date">Date de rencontre (annee-mois-jour)</label>
            <input name="1date" id="1date" type="text" placeholder="2011-02-20" value="<?php echo $donnees['1date']; ?>">
        </div>
        
        <div class="pure-control-group">
            <label for="ndate">Dernière rencontre (annee-mois-jour)</label>
            <input name="ndate" id="ndate" type="text" placeholder="2011-02-20" value="<?php echo $donnees['ndate']; ?>">
        </div>

        <div class="pure-control-group">
            <label for="member">Membre affecté</label>
            <input name="member" id="member" type="text" placeholder="Pierre Courdier" value="<?php echo $donnees['member']; ?>">
        </div>
        
        <div class="pure-control-group">
            <label for="school">Ecole du membre</label>
            <input name="school" id="school" type="text" placeholder="INSA Rennes" value="<?php echo $donnees['school']; ?>">
        </div>
        
        <div class="pure-control-group">
            <label for="answer">Réponse</label>
            <textarea name="answer" id="answer" placeholder="Oui, Non, Peut-être..."><?php echo $donnees['answer']; ?></textarea>
        </div>
        
        <div class="pure-control-group">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" placeholder="..."><?php echo $donnees['notes']; ?></textarea>
        </div>

        <div class="pure-controls">

            <button type="submit" class="pure-button pure-button-primary">Valider</button>
            <a class="pure-button" href="<?php echo $path; ?>/">Retour</a>
        </div>
    </fieldset>
</form>


<?php
require_once(__ROOT__.'/inc/footer.inc.php');
?>
