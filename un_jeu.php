<?php
require('loader.php'); //Ma ligne de base sur chacun de mes fichiers
if (!is_numeric($_GET['id'])) {
    $Alert->setAlert('Mauvais format de "id"');
    $Alert->redirectAlert('jeux.php');
}

$jeu = new Game($_GET['id']);
if (!$jeu->exist()) {
    $Alert->setAlert('Ce jeu n\'existe pas');
    $Alert->redirectAlert('jeux.php');
}

$html = new Bootstrap('Jeux', $jeu->name);
//Début du DOMHTML
echo $html->startDOM();

//Menu
include('elements/menu.php');

echo $html->menu();
$html->setDisplayRecherche(true);

//Main
echo $html->startMain();


// $nbJeux = $jeu->get('count');
//var_dump($nbJeux);
// ___________________________________________
// define('HOST', 'localhost');
// define('DBNAME', 'gamegram');
// define('USER', 'root');
// define('PASSWORD', '');

// try {
//     $pdo = new PDO('mysql:host=' . HOST . '; dbname=' . DBNAME . '', USER, PASSWORD);
// } catch (PDOException $e) {
//     print "ERREUR !: " . $e->getMessage();
//     die();
// }

// $id = htmlspecialchars($_GET['id']);
// //Préparation de la requête 
// $sql = 'SELECT id, family_id, platform_id, publisher_id, name, public, note, year FROM games WHERE id= :id';
// $query = $pdo->prepare($sql);
// $query->bindValue(':id', $id, PDO::PARAM_INT); //Sécurité contre les injections sql
//OWASP Top 10: 10 familles de failles de sécurité les + courantes

//Execution de la requête
// $query->execute();

// //Récupération des données
// $nbJeux = $query->rowCount();
// $jeu = $query->fetch();
//var_dump($jeu);

// if ($nbJeux == 0) {
//     $Alert->setAlert('Ce jeu n\'exite pas');
// }

//Récupérer le publisher, la familly et la platform
// function sqlGamesById($jeu, $table, $target)
// {
//     $sql = 'SELECT name FROM ' . $table . ' WHERE id=' . $jeu['' . $target . '_id'];
//     return $sql;
// }
// $query = $pdo->query(sqlGamesById($jeu, 'publishers', 'publisher'));
// $query->execute();

// $query1 = $pdo->query(sqlGamesById($jeu, 'families', 'family'));
// $query1->execute();

// $query2 = $pdo->query(sqlGamesById($jeu, 'platforms', 'platform'));
// $query2->execute();

// $publisher = $query->fetch();
// // var_dump($publisher);
// $familly = $query1->fetch();
// $platform = $query2->fetch();
//TODO: Requête préparé pour récupérer le publisher, la familly et la platform
//TODO: Finir affichage de un_jeu.php
//TODO: BOOTSTRAP.php => faire 2 nouvelles méthodes pour gérer les badges et les alertes
//TODO: Gérer le cas où l'id ne correspond pas un jeu (par exemple 1500)

//$jeu = $Game->getById($_GET['id']);

?>

<div class="starter-template text-center py-5 px-3">
    <h1>Le jeu <?= $jeu->name; ?></h1>
    <p><?= $html->badge('Année: ' . $jeu->year, ['color' => SUCCESS]); ?></p>
    <div class="row">
        <div class="col-12 col-md-4">
            <p><?= $html->badge('Editeur: ' . $jeu->Publisher->name, ['color' => PRIMARY]); ?></p>
        </div>
        <div class="col-12 col-md-4">
            <p><?= $html->badge('Genre: ' . $jeu->Family->name, ['color' => INFO]); ?></p>
        </div>
        <div class="col-12 col-md-4">
            <p><?= $html->badge('Plateforme: ' . $jeu->Platform->name, ['color' => SECONDARY]); ?></p>
        </div>
    </div>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum itaque adipisci officia doloremque id fuga doloribus, ratione ex accusamus iure quod quos! Nulla nihil earum officiis. Suscipit amet obcaecati aperiam incidunt optio, reiciendis tempore magni dolorum tempora dolores velit quibusdam!</p>
</div>
<p>
    <?= $html->button('&larr; Retour', 'jeux.php', ['color' => 'light']); ?>
</p>
</div>

<?php
echo  $html->endMain();
echo  $html->endDOM();
?>