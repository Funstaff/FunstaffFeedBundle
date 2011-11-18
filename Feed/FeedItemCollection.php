<?php

namespace Funstaff\FeedBundle\Feed;

/**
 * FeedItemCollection
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemCollection
{
    private $collection;

    /**
     * Add
     *
     * @param itemInterface $item
     */
    public function add($item)
    {
        $this->collection[] = $item;
    }

    /**
     * Get
     *
     * @return array $collection
     */
    public function get()
    {
        return $this->collection;
    }
}