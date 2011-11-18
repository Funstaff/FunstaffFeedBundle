<?php

namespace Funstaff\FeedBundle\Renderer;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class RendererBase
{
    protected $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }
}