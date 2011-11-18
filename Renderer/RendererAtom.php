<?php

namespace Funstaff\FeedBundle\Renderer;

use Funstaff\FeedBundle\Renderer\RendererBase;
use Funstaff\FeedBundle\Renderer\RendererInterface;
use Funstaff\FeedBundle\Feed\FeedInterface;

/**
 * RendererAtom
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RendererAtom extends RendererBase implements RendererInterface
{
    public function render(FeedInterface $feed, $version)
    {
        return 'atom';
    }
}