<?php

//Héritage des méthodes de ORM
class Family extends ORM
{
    public function __construct($id = null)
    {
        //Appel du parent de game => ORM
        parent::__construct();
        $this->setTable('families');

        if ($id != null) {
            $this->populate($id);
        }
    }

    public function  create($name)
    {
        $this->addInsertFields('name', $name, PDO::PARAM_STR);
        //PAS $this->get('...')
        //TODO: faire la fonction insert
        $this->insert();
        //TODO: retourne le nouvel id crée
        // echo '<pre>';
        // print_r($this->insert());
        // echo '</pre>';
        $newId = $this->getLastInsertId();
        // echo $newId;
        $this->populate($newId);
    }
}

//Insert s'inspire de la méthode get
//Dans test.php
// $family = new family();
// $family->create('RPG');

// echo $family->name;
// echo $family->id;
