<?php
// Constantes liées à Bootstrap
define('WARNING', 'warning');
define('SUCCESS', 'success');
define('PRIMARY', 'primary');
define('SECONDARY', 'secondary');
define('DANGER', 'danger');
define('INFO', 'info');
define('LIGHT', 'light');
define('DARK', 'dark');

//Elements
define('BTN', 'btn');
define('BADGE', 'badge');
define('BG', 'bg');

class Bootstrap
{
    private $title;
    private $content;
    private $menuItems = [];
    private $displayRecherche;


    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
        $this->startDOM();
    }

    //Méthodes
    public function startDOM()
    {
        return '<!doctype html>
        <html lang="fr">
        
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>' . NAME_APPLICATION . ' - ' . $this->title . '</title>
            <meta name="description" content="' . $this->content . '">
        
        
            <!-- Bootstrap core CSS -->
            <link href="' . DIR_ASSETS . DIR_CSS . 'boostrap.css" rel="stylesheet">
        
            <!-- Custom styles for this template -->
            <link href="' . DIR_ASSETS . DIR_CSS . 'theme.css" rel="stylesheet">
        </head>
        ';
    }

    public function menu()
    {

        $menuHtml = ' <nav class="navbar navbar-expand-md navbar-dark bg-success">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">' . NAME_APPLICATION . '</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">';
        foreach ($this->menuItems as $item) {
            $menuHtml .= ' <li class="nav-item">
            <a class="nav-link" href="' . $item['link'] . '">' . $item['name'] . '</a></li>';
        }
        $menuHtml .= '</ul>';

        if ($this->displayRecherche) {
            $menuHtml .= '
                    <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>';
        }


        $menuHtml .= '</div>
        </div>
    </nav>';

        return $menuHtml;
    }

    public function image($name, $options = [])
    {
        //gérer mon alt
        $alt = '';
        if (isset($options['alt'])) {
            $alt = $options['alt'];
        }

        $class = $options['class'] ?? '';
        //Classes supplémentaires

        // //Equivalent du if ternaire
        // $alt = isset($options['alt']) ? $options['alt'] : '';

        // //Equivalent avec ?? pour remplacer le isset
        // $alt = $options['alt'] ?? '';

        return '<p><img src="' . DIR_ASSETS . DIR_IMG . $name . '" class="' . $class . '" style="max-width:50%" alt="' . $options['alt'] . '" ></p>';
    }

    //Ajouter Bouton
    public function button($name, $link, $options = [])
    {
        //Gestion de la couleur
        $color = $options['color'] ?? PRIMARY;
        return '<a class="' . BTN . ' ' . BTN . '-' . $color . ' my-3" href="' . $link . '" role="button">' . $name . '</a>';
    }


    public function badge($text, $options = [])
    {
        //Gestion de la couleur
        $color = $options['color'] ?? PRIMARY;
        //Class par défaut
        $class = BADGE . ' ' . BG . '-' . $color . '';
        //Classes supplémentaires
        $class .= $options['class'] ?? '';

        return '<span class="' . $class . '">' . $text . '</span>';
    }

    public function alert($text, $options = [])
    {
        $alert = new BootstrapAlert($text, $options);
        return $alert->alert();
    }

    //Ajouter Menu
    public function addMenu($name, $link)
    {

        $this->menuItems[] =  [
            "name" => $name,
            "link" => $link
        ];
    }

    public function startMain()
    {
        return '<body><main class="container">';
        // return '<body><main class="container">' . $this->Alert->getAlertHtml();
    }

    public function endMain()
    {
        return '</main>';
    }

    public function endDOM()
    {
        return '
        <script src="' . DIR_ASSETS . DIR_JS . 'bootstrap.min.js"></script>
        <script src="' . DIR_ASSETS . DIR_JS . 'main.js"></script>
        </body>
        </html>';
    }

    //Getteurs / assesseurs

    /**
     * Set the value of displayRecherche
     *
     * @return  self
     */
    public function setDisplayRecherche($value)
    {
        if ($value) {
            return $this->displayRecherche;
        }
    }
}
