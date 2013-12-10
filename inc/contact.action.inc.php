<?php 
$donnees = [];
if (isset($_GET['id'])) {
    $request = $bdd->prepare('SELECT * FROM cdb_people WHERE id=?');
    $request->execute(array($_GET['id']));
    $donnees = $request->fetch();
}
?>
