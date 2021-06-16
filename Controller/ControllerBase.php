<?php

namespace Controller;

use App\Src\App;

abstract class ControllerBase
{

    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    protected function render(String $template, Array $params = [])
    {
        if ($template === '404')
        {
            header("HTTP/1.0 404 Not Found");
        }

        ob_start();
        include __DIR__ . '/../View/' . $template . '.php';
        ob_end_flush();
        die();
    }
}