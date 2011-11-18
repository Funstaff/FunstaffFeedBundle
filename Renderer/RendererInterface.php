<?php

namespace Funstaff\FeedBundle\Renderer;

use Funstaff\FeedBundle\Feed\FeedInterface;

/**
 * RendererInterface
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
Interface RendererInterface
{
    function render(FeedInterface $feed, $version);
}