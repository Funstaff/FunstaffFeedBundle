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

    public function populateChild($element, $key, array $child)
    {
        foreach ($child as $value) {
            $element->addChild($key, $value);
        }
    }

    public function populateAttribute($element, $key, array $attribute)
    {
        $node = $element->addChild($key);
        foreach ($attribute as $k => $v) {
            $node->addAttribute($k, $v);
        }
    }
}