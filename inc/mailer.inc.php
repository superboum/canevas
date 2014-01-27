<?php

function sendMail($email, $body, $headers, $id=0) {
    $personnalUrl = $domain.$path."/index.php?action=unsubscribe&email=".$id;
    $messagePers = str_replace("[URL]",$personnalUrl,$body);
    mail($email, '[canvass] Clients a recontacter', $messagePers, implode("\r\n", $headers));
}

$request = $bdd->prepare('SELECT id, entreprise, name, ndate, member FROM cdb_people WHERE TO_DAYS(NOW()) - TO_DAYS(ndate) >= ? ORDER BY member ASC, ndate ASC');
$request->execute(array($timeBeforeNewContact));

$data = false;

$message = "<html>
                <head></head>
                <body>
                    <p>Pour vous désinscrire, <a href=\"[URL]\">cliquez ici</a></p>
                    <p>Voici la liste des personnes que vous n'avez pas contacté depuis plus de ".$timeBeforeNewContact." jours.</p>
          ";

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=utf-8";
$headers[] = "X-Mailer: PHP/".phpversion();

$lastMember = null;
while ($donnees = $request->fetch()) {

    $data = true ;

    if ($donnees['member'] != $lastMember) {
        if ($lastMember != null) {
            $message .= "</table>";
        }
        $message .= "<table>
                        <caption>".$donnees['member']."</caption>
                        <tr>
                            <th>Entreprise</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    ";
    }
    
    $message .= "<tr>
                    <td>".$donnees['entreprise']."</td>
                    <td>".$donnees['ndate']."</td>
                    <td> Soon </td>
                 </tr>";
   


}

$request->closeCursor();

$message .= "       </table>
               </body>
            </html>";


if ($data) {
    
    if (isset($_GET['sendTo'])) {
        sendMail($_GET['sendTo'], $message, $headers);
    } else {
        $mailing = $bdd->query('SELECT id,email FROM cdb_mailing');
        while ($donnees = $mailing->fetch()) {
            sendMail($donnees['email'], $message, $headers, $donnees['id']);
        }
    }
}

?>
