<?php

namespace Asus\Haste;

use Jenssegers\Blade\Blade;

class Views
{


    protected Blade $blade;
    public function __construct()
    {
        $this->blade = new Blade(
                Application::$ROOT_DIR . "/resources/views",
                Application::$ROOT_DIR."/storage/cache/views"
            );
    }

    public function render(string $view,array $data=[])
    {
       return $this->blade->render($view,$data);
    }
}
