<?php

namespace Funstaff\FeedBundle\Feed;

/**
 * FeedItemCategory
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemCategory
{
    protected $category;

    protected $domain;

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    public function getDomain()
    {
        return $this->domain;
    }
}