<?php

namespace Funstaff\FeedBundle\Feed;

/**
 * FeedItemGuid
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemGuid
{
    protected $link;

    protected $isPermalink = false;

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setIsPermalink($permalink)
    {
        $this->isPermalink = $permalink;
    }

    public function isPermalink()
    {
        return $this->isPermalink;
    }
}