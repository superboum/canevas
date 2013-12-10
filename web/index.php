<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__.'/inc/conf.inc.php');
require_once(__ROOT__.'/inc/header.inc.php');
require_once(__ROOT__.'/inc/list.action.inc.php');

?>
            

            <h2 class="content-subhead">Liste des contacts</h2>
            <a class="pure-button pure-button-primary" href="<?php echo $path; ?>/form.php">Ajouter un contact</a>
            <a class="pure-button" href="<?php echo $path; ?>/mail.php">Notification mail</a>
            <form class="pure-form search" action="<?php echo $path; ?>/index.php" method="GET">
                <input name="keyword" type="text" class="pure-input-rounded">
                <input name="action" value="search" style="display:none">
                <button type="submit" class="pure-button">Chercher</button>
            </form>
            <p>
                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Entreprise</th>
                            <th>Personne</th>
                            <th>Der. fois</th>
                            <th>Membre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php while ($donnees = $request->fetch()) { ?>
                        <tr>
                            <td><?php echo $donnees['id'] ?></td>
                            <td><?php echo $donnees['entreprise'] ?></td>
                            <td><?php echo $donnees['name'] ?></td>
                            <td><?php echo $donnees['ndate'] ?></td>
                            <td><?php echo $donnees['member'] ?></td>
                            <td>
                                <a class="pure-button" href="<?php echo $path; ?>/view.php?id=<?php echo $donnees['id'] ?>">
                                    <img width="14" src="<?php echo $path; ?>/img/view.png"/>
                                </a>
                                
                                <a class="pure-button pure-button-error" href="<?php echo $path; ?>/confirm.php?action=remove&id=<?php echo $donnees['id'] ?>">
                                    <img width="14" src="<?php echo $path; ?>/img/remove.png"/>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </p>
            <a class="pure-button pure-button-primary" href="<?php echo $path; ?>/form.php">Ajouter un contact</a>
            <a class="pure-button" href="<?php echo $path; ?>/mail.php">Notification mail</a>
            <form class="pure-form search" action="<?php echo $path; ?>/index.php" method="GET">
                <input name="keyword" type="text" class="pure-input-rounded">
                <input name="action" value="search" style="display:none">
                <button type="submit" class="pure-button">Chercher</button>
            </form>

<?php
$request->closeCursor();
require_once(__ROOT__.'/inc/footer.inc.php');
?>
