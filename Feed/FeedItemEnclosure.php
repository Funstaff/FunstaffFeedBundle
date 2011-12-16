<?php

namespace Funstaff\FeedBundle\Feed;

/**
 * FeedItemEnclosure
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemEnclosure
{
    protected $url;

    protected $length = 0;

    protected $type;

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getLength()
    {
        return (int) $this->length;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }
}