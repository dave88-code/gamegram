<?php
require('loader.php'); //Ma ligne de base sur chacun de mes fichiers

//Sécurité si déjà connecté
if ($Auth->logged) {
    $Alert->setAlert('Vous êtes connecté !', ['color' => SUCCESS]);
    $Alert->redirectAlert('./index.php');
}

$html = new Bootstrap('Connexion', 'Connexion ' . NAME_APPLICATION . ' !');
//Début du DOMHTML
echo $html->startDOM();

//Menu
include_once('./elements/menu.php');
echo $html->menu();

//Main
echo $html->startMain();
?>
<div class="starter-template py-5 px-3">
    <p class="text"><?= $Alert->getAlertHTML(); ?></p>
    <h1 class=" text-center">Connexion</h1>
    <?php
    $form = new BootstrapForm('connexion', 'controllers.php', METHOD_POST);
    // var_dump($form);

    //Préparation 
    $form->addInput('username', TYPE_EMAIL, ['label' => 'Adresse mail', 'placeholder' => 'Entrez votre adresse mail']);
    $form->addInput('password', TYPE_PASSWORD, ['label' => 'mot de passe', 'placeholder' => '8 caractères minimum']);
    $form->setSubmit('Je me connecte', ['color' => SUCCESS]);
    //Affichage du formulaire
    echo  $form->form();
    //var_dump($_POST);
    ?>
    <hr>
    <p class="text-center">Pas encore connecter!!</p>
    <p class="text-center"><?= $html->button('S\'inscrire', './inscription.php', ['color' => WARNING]); ?></p>
</div>

<?php
echo  $html->endMain();
echo  $html->endDOM();
?>