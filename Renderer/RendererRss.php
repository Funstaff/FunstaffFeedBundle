<?php

namespace Funstaff\FeedBundle\Renderer;

use Funstaff\FeedBundle\Renderer\RendererBase;
use Funstaff\FeedBundle\Renderer\RendererInterface;
use Funstaff\FeedBundle\Feed\FeedInterface;

/**
 * RendererRss
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RendererRss extends RendererBase implements RendererInterface
{
    public function render(FeedInterface $feed, $version)
    {
        return 'rss';
    }
}