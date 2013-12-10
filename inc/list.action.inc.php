<?php
if (!isset($_GET['action'])) {
    
} else if ($_GET['action'] === 'add') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $addContact = $bdd->prepare('INSERT INTO 
            cdb_people(entreprise, name, poste, email, phone, 1place, 1date, 
                ndate, member, school, answer, notes) 
            VALUES(:entreprise, :name, :poste, :email, :phone, :onePlace, 
                :oneDate, :ndate, :member, :school, :answer, :notes )');
        $addContact->execute(array(
            'entreprise' => $_POST['entreprise'],
            'name' => $_POST['name'],
            'poste' => $_POST['poste'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'onePlace' => $_POST['1place'],
            'oneDate' => $_POST['1date'],
            'ndate' => $_POST['ndate'],
            'member' => $_POST['member'],
            'school' => $_POST['school'],
            'answer' => $_POST['answer'],
            'notes' => $_POST['notes']
        ));
    }
} else if ($_GET['action'] === 'update') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $addContact = $bdd->prepare('UPDATE cdb_people
            SET entreprise=:entreprise, name=:name, poste=:poste, email=:email, 
                phone=:phone, 1place=:onePlace, 1date=:oneDate, ndate=:ndate, 
                member=:member, school=:school, answer=:answer, notes=:notes
            WHERE id=:id ');
        $addContact->execute(array(
            'entreprise' => $_POST['entreprise'],
            'name' => $_POST['name'],
            'poste' => $_POST['poste'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'onePlace' => $_POST['1place'],
            'oneDate' => $_POST['1date'],
            'ndate' => $_POST['ndate'],
            'member' => $_POST['member'],
            'school' => $_POST['school'],
            'answer' => $_POST['answer'],
            'notes' => $_POST['notes'],
            'id' => $_GET['id'],
        ));
    }
} else if ($_GET['action'] === 'remove') {
    $removeContact = $bdd->prepare('DELETE FROM cdb_people WHERE id=?;');
    $removeContact->execute(array($_GET['id']));
} else if ($_GET['action'] === 'contact') {
    $updateContact = $bdd->prepare('UPDATE cdb_people SET ndate=? WHERE id=?;');
    $updateContact->execute(array(date("y-m-d"), $_GET['id']));
} else if ($_GET['action'] === 'email') {
    $addMail = $bdd->prepare('INSERT INTO cdb_mailing(email) VALUES(?);');
    $addMail->execute(array($_POST['email']));
} else if ($_GET['action'] === 'unsubscribe') {
    $rmMail = $bdd->prepare('DELETE FROM cdb_mailing WHERE id=?;');
    $rmMail->execute(array($_GET['id']));
}

if (isset($_GET['action']) && $_GET['action'] === 'search') {
    $keyword = '%'.$_GET['keyword'].'%';
    $request = $bdd->prepare('SELECT id, entreprise, name, ndate, member FROM cdb_people WHERE entreprise LIKE ? OR name LIKE ? OR email LIKE ? OR member LIKE ? ORDER BY ndate ASC');
    $request->execute(array($keyword, $keyword, $keyword, $keyword));
} else {
    $request = $bdd->query('SELECT id, entreprise, name, email, ndate, member FROM cdb_people ORDER BY ndate ASC');
}

?>
