<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/conf.inc.php');
require_once(__ROOT__.'/inc/header.inc.php');

?> 

<h2 class="content-subhead">Confirmation nécessaire !</h2>
<p>
Veuillez confirmer la suppression du contact.
</p>
<a class="pure-button pure-button-error" href="<?php echo $path; ?>/index.php?action=<?php echo $_GET['action'] ?>&id=<?php echo $_GET['id'] ?>" >Confirmer</a>
<a class="pure-button" href="<?php echo $path; ?>/">Retour</a>

<?php
require_once(__ROOT__.'/inc/footer.inc.php');
?>
