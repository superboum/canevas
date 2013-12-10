<?php
$request = $bdd->prepare('SELECT id, entreprise, name, ndate, member FROM cdb_people WHERE TO_DAYS(NOW()) - TO_DAYS(ndate) >= ? ORDER BY ndate ASC');
$request->execute(array($timeBeforeNewContact));

$message = "Voici la liste des personnes que vous n'avez pas contacté depuis plus de ".$timeBeforeNewContact." jours.\r\n\r\n";
$data = false;

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=utf-8";
//$headers[] = "From: Sender Name <sender@domain.com>";
//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
//$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
//$headers[] = "Subject: {$subject}";
$headers[] = "X-Mailer: PHP/".phpversion();


while ($donnees = $request->fetch()) {
    $message .= $donnees['name']." de ".$donnees['entreprise']. " a été contacté la dernière fois le ".$donnees['ndate'].". Affecté à ".$donnees['member'].".\r\n";
    $data = true ;
}

$request->closeCursor();


if ($data) {
    $message = wordwrap($message, 70, "\r\n");
    $mailing = $bdd->query('SELECT email FROM cdb_mailing');
    while ($donnees = $mailing->fetch()) {
        mail($donnees['email'], '[canvass] Clients à recontacter', $message, implode("\r\n", $headers));
    }
}

?>
