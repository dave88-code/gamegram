<?php

//Héritage des méthodes de ORM
class Game extends ORM
{

    public $Platform;
    public $Publisher;
    public $Family;

    public function __construct($id = null)
    {
        //Appel du parent de game => ORM
        parent::__construct();
        $this->setTable('games');
        if ($id != null) {
            $this->populate($id);
        }
    }

    //Méthodes spécifique à ce modèle
    public function listOfPublicGames()
    {
        //Ajoute les champs
        $this->setSelectFields('id', 'name', 'year', 'note');
        //Récupère que les publics
        $this->addWhereFields('public', 1);
        $this->addOrder('name');
        //Ordre aléatoire
        $this->addOrder('', 'RAND()'); //ORDER BY RAND()
        return $this->get('all');
    }

    //Pour compter les jeux
    // public function countPublicGames()
    // {
    //     //Ajoute les champs
    //     $this->setSelectFields('id');
    //     //Récupère que les publics
    //     $this->addWhereFields('public', 1);

    //     return $this->get('count');
    // }

    //Function du coeur du système
    public function populate($id)
    {
        if (parent::populate($id)) {

            $this->Platform = new Platform($this->platform_id);
            $this->Publisher = new Publisher($this->publisher_id);
            $this->Family = new Family($this->family_id);
        }
    }
}
