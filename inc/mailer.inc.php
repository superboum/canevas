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
                <head>
                    <style>
                        table
                        {
                            font-family: Arial, Helvetica, sans-serif;
                            width:100%;
                            border-collapse:collapse;
                        }
                        table td, table th 
                        {
                            font-size:1em;
                            border:1px solid #98bf21;
                            padding:3px 7px 2px 7px;
                        }
                        table th 
                        {
                            font-size:1.1em;
                            text-align:left;
                            padding-top:5px;
                            padding-bottom:4px;
                            background-color:#A7C942;
                            color:#ffffff;
                        }
                        table tr.alt td 
                        {
                            color:#000000;
                            background-color:#EAF2D3;
                        }
                    </style>
                </head>
                <body>
                    <p>Pour vous désinscrire, <a href=\"[URL]\">cliquez ici</a></p>
                    <p>Voici la liste des personnes que vous n'avez pas contacté depuis plus de ".$timeBeforeNewContact." jours.</p>
          ";

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/html; charset=utf-8";
$headers[] = "X-Mailer: PHP/".phpversion();

$lastMember = "nobody";
while ($donnees = $request->fetch()) {

    $data = true ;

    if ($donnees['member'] != $lastMember) {
        if ($lastMember != "nobody") {
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
        $lastMember = $donnees['member'];
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
