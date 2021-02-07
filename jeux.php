<?php
require('loader.php'); //Ma ligne de base sur chacun de mes fichiers
$html = new Bootstrap('Jeux', 'Les jeux de ' . NAME_APPLICATION . ' !');
//Début du DOMHTML
echo $html->startDOM();

//Menu
include('./elements/menu.php');
echo $html->menu();
$html->setDisplayRecherche(true);

//Main
echo $html->startMain();
$game = new Game();
$listOfGames = $game->listOfPublicGames();


// $sql = 'SELECT id,name,note, year FROM games WHERE public = 1 ORDER BY name ASC';
// // $game->setSQL($sql);
// $jeux = $game->get('all');
// $nbJeux = $game->get('count');
// $orm = new ORM();

// // //Préparation de la requête 
// $sql = 'SELECT id,name,note, year FROM games WHERE public = 1 ORDER BY name ASC';
// //Execution de la requête
// $orm->setSQL($sql);


// // //Récupération des données
// $jeux = $orm->get('all');
// //Connaître le nombre de résultats
// $nbJeux = $orm->get('count');
// // var_dump($jeux);
// // var_dump($nbJeux);


?>

<div class="starter-template text-center py-5 px-3">
    <h1>Les Jeux</h1>
    <div class="container ">
        <div class="row justify-content-center">
            <h4>Il y a actuellement <em><?= count($listOfGames); ?> Jeux</em> dans la base.</h4>
            <?php foreach ($listOfGames as $jeu) : ?>
                <div class="card m-2" style="width: 20rem;">
                    <!-- <img src="..." class="card-img-top" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $jeu->name; ?></h5>
                        <p><?= $html->badge('Année: ' . $jeu->year, $options = ['color' => INFO]); ?></p>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, animi enim voluptas deleniti vero iusto totam vitae? Odio saepe incidunt nesciunt at vero tempore amet odit, quae accusamus quibusdam. Eos!</p>
                        <p>La note du public <strong><?= $jeu->note; ?> /10</strong></p>
                        <?= $html->button('Voir le Jeu', './un_jeu.php?id=' . $jeu->id, ['color' => 'success']); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
echo  $html->endMain();
echo  $html->endDOM();
?>