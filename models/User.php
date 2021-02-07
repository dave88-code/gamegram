<?php

class User extends ORM
{

    public function __construct($id = null)
    {
        //Appel du parent de game => ORM
        parent::__construct();
        $this->setTable('users');

        if ($id != null) {
            $this->populate($id);
        }
    }

    public function create($username, $password, $pseudo, $nbjoueurs)
    {
        $this->addInsertFields('username', $username, PDO::PARAM_STR);
        $this->addInsertFields('password', $password, PDO::PARAM_STR);
        $this->addInsertFields('pseudo', $pseudo, PDO::PARAM_STR);
        $this->addInsertFields('nb_games', $nbjoueurs, PDO::PARAM_INT);
        $this->addInsertFields('created', date('Y-m-d H:i:s'), PDO::PARAM_STR);

        $newId = $this->insert();
        // echo $newId;
        $this->populate($newId);
    }

    public function login($username, $cryptedPassword)
    {
        $this->addWhereFields('username', $username, '=', PDO::PARAM_STR);
        $this->addWhereFields('password', $cryptedPassword, '=', PDO::PARAM_STR);
        $this->setSelectFields('id');

        $user = $this->get('first');

        if (!empty($user)) {
            $this->populate($user['id']);
            return true;
        }
        return false;
    }
}
