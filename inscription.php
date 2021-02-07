<?php
require('loader.php'); //Ma ligne de base sur chacun de mes fichiers

//Sécurité sur le fait d'être déjà connecté
if ($Auth->logged) {
    $Alert->setAlert('Vous êtes connecté !', ['color' => SUCCESS]);
    $Alert->redirectAlert('index.php');
}

$html = new Bootstrap('Inscription', 'Inscription' . NAME_APPLICATION . ' !');
//Début du DOMHTML
echo $html->startDOM();

//Menu
include_once('./elements/menu.php');
echo $html->menu();

//Main
echo $html->startMain();
?>

<div class="starter-template py-5 px-3">
    <h1 class=" text-center">Inscription</h1>
    <p class="text-center">Veuillez remplir le formulaire</p>
    <?php
    $form = new BootstrapForm('inscription', 'controllers.php', 'post');
    // var_dump($form);

    //Préparation 
    $form->addInput('username', TYPE_EMAIL, ['label' => 'Adresse mail', 'placeholder' => 'Entrez votre adresse mail']);
    $form->addInput('password', TYPE_PASSWORD, ['label' => 'Mot de passe', 'placeholder' => '8 caractères minimum']);
    $form->addInput('pseudo', TYPE_TEXT, ['label' => 'Pseudo', 'placeholder' => 'Quelque chose d\'unique qui te caractérise !']);
    $form->addInput('nb_jeux', TYPE_NUMBER, ['label' => 'Nombre de jeux', 'placeholder' => 'Pour savoir quel joueur tu es?', 'min' => 0, 'max' => 100, 'step' => 1]);
    $form->setSubmit('Je m\'inscris', ['color' => SUCCESS]);
    //Affichage du formulaire
    echo  $form->form();
    //var_dump($_POST);
    ?>
    <hr>
    <p class="text-center">Déjà inscrit ?</p>
    <p class="text-center"><?= $html->button('Connexion', 'connexion.php', ['color' => WARNING]); ?></p>
</div>

<?php
echo  $html->endMain();
echo  $html->endDOM();
?>