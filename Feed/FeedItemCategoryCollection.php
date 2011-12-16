<?php

namespace Funstaff\FeedBundle\Feed;

use Funstaff\FeedBundle\Feed\FeedItemCategory;

/**
 * FeedItemCategoryCollection
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemCategoryCollection
{
    protected $collection;

    public function add(FeedItemCategory $item)
    {
        $this->collection[] = $item;
    }

    public function get()
    {
        return $this->collection;
    }
}