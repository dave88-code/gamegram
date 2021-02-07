<?php
define('METHOD_POST', 'post');
define('METHOD_GET', 'get');
define('METHODS', ['get', 'post']);
define('SESSION_VALUE', 'session_value');


define('TYPE_TEXT', 'text'); //Champ text
define('TYPE_PASSWORD', 'password'); //Champ password
define('TYPE_NUMBER', 'number'); //Champ numérique
define('TYPE_HIDDEN', 'hidden'); //Champ caché
define('TYPE_EMAIL', 'email'); //Champ caché
define('TYPES', [TYPE_TEXT, TYPE_NUMBER, TYPE_PASSWORD, TYPE_TEXT, TYPE_EMAIL]);
define('FORM_LABEL', 'form-label');
define('FORM_CONTROL', 'form-control');

class BootstrapForm
{
    //Propriétés
    private $action; //Notre Page "d'attérisage"
    private $method; //GET ou POST

    private $inputs = []; //Tous nos champs
    private $submit = []; //Informations de notre bouton submit
    private $htmlAttributs; //Pour gérer efficacement les attributs HTML de mes inputs

    // constructeur 
    public function __construct($name, $action, $method = METHOD_POST)
    {
        //$name => "slug" => 'inscription nouvel utilisateur' => Inscription_nouvel_utilisateur'
        if (!in_array($method, METHODS)) {
            die('Erreur fatale (BF 001) mauvaise configuration du constructeur ' . $method);
        }
        $this->name = $this->slug($name);
        $this->action = $action;
        $this->method = $method;
        //On va controler la méthode : METHOD_GET ou METHOD_POST

    }

    public function addInput($name, $type, $options = [])
    {
        if (!in_array($type, TYPES)) {
            die('Erreur fatale (BF 002) mauvaise configuration du champ ' . $name);
        }
        //$form->addInput('username', TYPE_TEXT);
        //$form->addInput('password', TYPE_PASSWORD);
        $this->inputs[] = [
            'name' => $name,
            'type' => $type,
            'options' => $options
        ];
    }

    //Retourne html
    public function input($name, $type, $options = [])
    {
        $input = ' <div class="mb-3">';
        //Je concatèene le nom du formulaire et le nom du champ
        if (isset($this->name)) {
            $id = $this->slug($this->name . ' ' . $name);
        }
        if ($type != TYPE_HIDDEN) {
            $label = $options['label'] ?? $name;
            $input .= '<label for="' . $id . '" class="' . FORM_LABEL . '">' . ucfirst($label) . '</label>';
        }

        //Mes attributs HTML supplementaires
        $this->htmlAttributs = '';
        //Options: label, placeholder, value, step, min, max
        $placeholder = $options['placeholder'] ?? '';

        if ($type === TYPE_NUMBER) {
            $this->handleHtmlAttributs($options, 'step');
            $this->handleHtmlAttributs($options, 'min');
            $this->handleHtmlAttributs($options, 'max');
        }

        //et value, pour tout le monde sauf password
        if ($type !== TYPE_PASSWORD) {
            $this->handleValue($name, $options);
        }

        $input .= '<input type="' . $type . '" class="' . FORM_CONTROL . '" name="' . $name . '" id="' . $this->slug($name) . '" ' . $this->htmlAttributs . ' placeholder="' . $placeholder . '" >';
        $input .= $this->handleHelpAlert($name);
        $input .= '</div>';
        return $input;
    }


    private function handleHelpAlert($name)
    {
        if (!isset($_SESSION[PROCESS_FORM_SESSION_HELP . $name])) {
            return '';
        }

        $help = $_SESSION[PROCESS_FORM_SESSION_HELP . $name];
        unset($_SESSION[PROCESS_FORM_SESSION_HELP . $name]);

        return '<div class="form-text badge bg-danger mt-2">' . $help . '</div>';
    }

    private function handleValue($name, $options = [])
    {
        if (isset($_SESSION[PROCESS_FORM_SESSION . $name])) {
            $this->htmlAttributs .= 'value="' . $_SESSION[PROCESS_FORM_SESSION . $name] . '"';
            unset($_SESSION[PROCESS_FORM_SESSION . $name]);
        } else {
            $this->handleHtmlAttributs($options, 'value');
        }
    }


    private function handleHtmlAttributs($options, $field)
    {
        if (isset($options[$field])) {
            $this->htmlAttributs .= $field . '="' . $options[$field] . '"';
        }
    }


    public function setSubmit($name, $options = [])
    {
        //$form->setSubmit('Je m\'inscris', ['color' => success]);
        $this->submit = [
            'name' => $name,
            'options' => $options
        ];
    }

    //Retourne html
    public function submit()
    {
        $color = $this->submit['options']['color'] ?? PRIMARY;
        return '<button type="submit" class="' . BTN . ' ' . BTN . '-' . $color . ' w-100 btn-lg">' . $this->submit['name'] . '</button>';
    }
    //Construction HTML complète du formulaire
    public function form()
    {
        $form = '<div class="container d-flex justify-content-center">';
        $form .= '<div class="col-12 col-md-8 col-lg-7">';
        $form .= '<form class="card p-4" method="' . $this->method . '" action="' . $this->action . '">';
        //Pour savoir sur la page d'atterissage quel est le formaulaire soumis
        $form .= $this->input($this->name, TYPE_HIDDEN);

        foreach ($this->inputs as $input) {
            $form .= $this->input($input['name'], $input['type'], $input['options']);
        }
        $form .= $this->submit();
        $form .= '</form></div></div>';

        return $form;
    }

    function slug($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $string)));
    }
}
