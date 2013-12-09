<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/conf.inc.php');
require_once(__ROOT__.'/inc/header.inc.php');

?> 

<h2 class="content-subhead">Notification mail</h2>
<p>Chaque semaines, les personnes qui n'ont pas été contactées depuis plus de <?php echo $timeBeforeNewContact; ?> jours vous seront notifiées par email.</p>
<form class="pure-form pure-form-aligned" method="POST" action="/index.php?action=email">
    <fieldset>
        <div class="pure-control-group">
            <label for="email">Votre email</label>
            <input name="email" id="email" type="email" placeholder="john.johnson@domain.tld">
        </div>
        
        
        <div class="pure-controls">

            <button type="submit" class="pure-button pure-button-primary">Valider</button>
            <a class="pure-button" href="/">Retour</a>
        </div>
        
    </fieldset>
</form>

<?php
require_once(__ROOT__.'/inc/footer.inc.php');
?>
