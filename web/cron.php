<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/inc/conf.inc.php');

$request = $bdd->prepare('SELECT id, entreprise, name, ndate, member FROM cdb_people WHERE TO_DAYS(NOW()) - TO_DAYS(ndate) >= ? ORDER BY ndate ASC');
$request->execute(array($timeBeforeNewContact));

$message = "Voici la liste des personnes à contacter au plus vite !\r\n\r\n";
$data = false;

while ($donnees = $request->fetch()) {
    $message .= $donnees['name']." de ".$donnees['entreprise']. " a été contacté la dernière fois le ".$donnees['ndate'].". Affecté à ".$donnees['member'].".\r\n";
    $data = true ;
}

$request->closeCursor();

if ($data) {
    $message = wordwrap($message, 70, "\r\n");
    $mailing = $bdd->query('SELECT email FROM cdb_mailing');
    
    while ($donnees = $request->fetch()) {
        mail($donnees['email'], '[canvass] Clients à recontacter', $message);
    }
}

?>
