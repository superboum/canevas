<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/conf.inc.php');
require_once(__ROOT__.'/inc/header.inc.php');

$request = $bdd->prepare('SELECT * FROM cdb_people WHERE id=?');
$request->execute(array($_GET['id']));
$donnees = $request->fetch();
?> 

<h2 class="content-subhead">Details du contact</h2>
<h4>Perso</h4>
<p>
<?php echo $donnees['entreprise'] ?><br/>
<?php echo $donnees['name'] ?><br/>
<?php echo $donnees['poste'] ?><br/>
<?php echo $donnees['phone'] ?><br/>
<?php echo $donnees['email'] ?><br/>


<h4>Dates</h4>
Premier contact : <?php echo $donnees['1place'] ?>, le <?php echo $donnees['1date'] ?><br/>
Dernier contact : le <?php echo $donnees['1date'] ?><br/>

<h4>Dossier</h4>
Membre : <?php echo $donnees['member'] ?><br/>
Ecole : <?php echo $donnees['school'] ?><br/>
Réponse : <?php echo $donnees['answer'] ?><br/>
Notes : <?php echo $donnees['notes'] ?><br/>
</p>

<a class="pure-button pure-button-success" href="<?php echo $path; ?>/index.php?action=contact&id=<?php echo $donnees['id'] ?>" >Contacté <img width="14" src="/img/contact.png"/></a>
<a class="pure-button" href="<?php echo $path; ?>/edit.php?id=<?php echo $donnees['id'] ?>">Modifier</a>
<a class="pure-button" href="<?php echo $path; ?>/">Retour</a>

<?php
$request->closeCursor();
require_once(__ROOT__.'/inc/footer.inc.php');
?>
