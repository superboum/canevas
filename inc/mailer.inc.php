<?php
$request = $bdd->prepare('SELECT id, entreprise, name, ndate, member FROM cdb_people WHERE TO_DAYS(NOW()) - TO_DAYS(ndate) >= ? ORDER BY ndate ASC');
$request->execute(array($timeBeforeNewContact));

$message = "Voici la liste des personnes que vous n'avez pas contacté depuis plus de ".$timeBeforeNewContact." jours.\r\n\r\n";
$data = false;

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=utf-8";
$headers[] = "X-Mailer: PHP/".phpversion();


while ($donnees = $request->fetch()) {
    $message .= $donnees['name']." de ".$donnees['entreprise']. " a été contacté la dernière fois le ".$donnees['ndate'].". Affecté à ".$donnees['member'].".\r\n";
    $data = true ;
}

$request->closeCursor();


if ($data) {
    
    $mailing = $bdd->query('SELECT id,email FROM cdb_mailing');
    while ($donnees = $mailing->fetch()) {
        $messagePers = $message."\r\nPour vous désinscire, suivez ce lien ".$domain.$path."/index.php?action=unsubscribe&email=".$donnees['id'];
        //$messagePers = wordwrap($messagePers, 70, "\r\n");
        mail($donnees['email'], '[canvass] Clients à recontacter', $messagePers, implode("\r\n", $headers));
    }
}

?>
