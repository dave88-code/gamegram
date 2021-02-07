<?php
require('loader.php'); //Ma ligne de base sur chacun de mes fichiers
$html = new Bootstrap('Accueil', 'Bienvenue sur GameGram');
//Début du DOMHTML
echo $html->startDOM();

//Menu
include_once('./elements/menu.php');
echo $html->menu();

//Main
echo $html->startMain();
?>

<div class="starter-template text-center py-5 px-3">
    <h1>Présentation</h1>
    <p class="mt-3">C’est désormais établi : les jeux vidéo constituent une forme de média attirant un nombre grandissant d’individus, masculins mais aussi féminins, plutôt jeunes.[1] Le poids de l’industrie vidéoludique n’est pas négligeable : en France, les revenus issus des jeux vidéo et de l’e-sport devraient s’établir à $5.2 Mds d’ici 2023.</p>

    <p>Ce « boom » du jeu vidéo a été porté en partie par la dématérialisation du jeu et l’apparition de plateformes dédiées rassemblant de plus en plus de monde. Avec les nouveaux acteurs du secteur que sont Twitch, Discord ou encore le phénomène Fortnite, on observe l’émergence du « jeu interactif ». Désormais, il s’agit de jouer, mais aussi de parler, écrire et/ou regarder les autres jouer, le tout en temps réel. Les plateformes de jeux vidéo ont donné naissance à de nouvelles façons de communiquer et parviennent à capter l’attention d’un public élargi, au-delà des « gamers ». Alors que les plateformes sociales « classiques » comme Facebook sont progressivement délaissées par les plus jeunes[3], peut-on considérer les plateformes de jeux vidéo comme les nouveaux réseaux sociaux ?</p>

</div>

<?php
echo  $html->endMain();
echo  $html->endDOM();
?>