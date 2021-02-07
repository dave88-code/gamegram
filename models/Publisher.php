<?php

//Héritage des méthodes de ORM
class Publisher extends ORM
{
    public function __construct($id = null)
    {
        //Appel du parent de game => ORM
        parent::__construct();
        $this->setTable('publishers');

        if ($id != null) {
            $this->populate($id);
        }
    }
}
