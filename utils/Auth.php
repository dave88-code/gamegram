<?php
//Permet de gérer les sessions et de dire qu'un user est connecté
define('SESSION_USER_ID', 'session_user_id');
class Auth
{
    public $user;
    public $logged = false;

    public function __construct()
    {
        //A la construction de l'objet
        //Savoir s'il y a un user_id stocké en session
        //Je set mon user complet
        if (isset($_SESSION[SESSION_USER_ID])) {
            $this->setUser($_SESSION[SESSION_USER_ID]);
        }
    }


    public function setUser($idUser)
    {
        $this->User = new User($idUser);
        $this->logged = true;

        $_SESSION[SESSION_USER_ID] = $idUser;
    }


    public function logout()
    {
        $this->logged = false;
        unset($_SESSION[SESSION_USER_ID]);
        unset($this->user);
        session_destroy();
    }
}
