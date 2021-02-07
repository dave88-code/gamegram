<?php
require('loader.php');

//Tests manuel
echo '<pre>';
print_r($_SESSION);
unset($_SESSION);
session_destroy();
echo '</pre>';

if ($Auth->logged) {
    echo 'Je suis connecté';
    echo 'je suis' . $Auth->User->pseudo;
}


$pass = [
    ['pass' => '', 'ok' => false],
    ['pass' => 'aaa', 'ok' => false],
    ['pass' => 'abc', 'ok' => false],
    ['pass' => 'a3a', 'ok' => false],
    ['pass' => 'a65a', 'ok' => false],
    ['pass' => 'a6+', 'ok' => true],
    ['pass' => '8*d', 'ok' => true],
    ['pass' => '-erze48644', 'ok' => true],
    ['pass' => '48644zhir(]', 'ok' => true],
    ['pass' => '6466484687', 'ok' => false],
    ['pass' => '-*+-*--+*-', 'ok' => false],
    ['pass' => '-98eth54-+*-', 'ok' => true],
    ['pass' => '()684gerge)*-', 'ok' => true]
];

foreach ($pass as $p) {
    $validator = new Validator($p, 'url');

    if ($validator->validatePassword('pass', 3) === $p['ok']) {
        echo '<p style="color:green">Test OK</p>';
    } else {
        echo '<p style="color:red">Test KO</p>';
    }
}

// $orm = new ORM();
//Table Game
// $game = new Game(4);
// // echo 'Le jeu ' . $game->id . ' se nomme ' . $game->name
// //     . '<br> se joue sur ' . $game->Platform->name
// //     . '<br/>est du genre ' . $game->Family->name
// //     . '<br/> produit par ' . $game->Publisher->name;

// //Insert s'inspire de la méthode get
// //Dans test.php
// $family = new family();
// $family->create('RPG');
// // echo '<pre>';
// // print_r($family);
// // echo '</pre>';
// echo $family->name;
// echo $family->id;


// die();

//Table Platform
// $platform = new Platform();
// print_r($platform->getById(2));
// die();
// $orm->setTable('games');
// $orm->setSelectFields('id', 'name', 'note');
// $orm->addWhereFields('id', 14); //Je veux le numéro 14
// $orm->addWhereFields('platform_id', 1);
// $orm->addWhereFields('platform_id', 3);
// $orm->addWhereFields('platform_id', 5);
// $orm->setTypeWhere('OR'); //Je veux le numéro 14
// A la place$orm->setSQL('SELECT name FROM games');
// echo 'Il y a ' . $orm->get('count') . ' jeux dans la base';

// //Tous les éléments
// echo '<pre>';
// print_r($orm->get('all'));
// echo '</pre>';

// //Un  élément
// echo '<pre>';
// print_r($orm->get('first'));
// echo '</pre>';

// //Temps 2:
// $orm->setTable('games');
// $orm->setFields('name', 'score');
// //à la place de $orm 
