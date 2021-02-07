<?php
require('loader.php'); //Ma ligne de base sur chacun de mes fichiers
$html = new Bootstrap('Accueil', 'Bienvenue ' . NAME_APPLICATION . ' ! ');
//Début du DOMHTML
echo $html->startDOM();

//Menu
include('./elements/menu.php');
echo $html->menu();
$html->setDisplayRecherche(false);

//Main
echo $html->startMain();


?>

<div class="starter-template text-center py-5 px-3">
    <p class="text"><?= $Alert->getAlertHTML(); ?></p>
    <h1>GameGram</h1>
    <p class="lead">Un nouveau réseau social.<br>Centré sur l'univers des jeux vidéos Multijoueurs.</p>

    <p><?= $html->image('manettes.jpg', ['alt' => 'manettes de jeux', 'class' => 'rounded']); ?></p>

    <?= $html->button('Présentation', 'presentation.php', ['color' => INFO]); ?>
    <?= $html->button('Je crée un compte', 'inscription.php', ['color' => SUCCESS]); ?>

</div>

<?php
echo  $html->endMain();
echo  $html->endDOM();
?>