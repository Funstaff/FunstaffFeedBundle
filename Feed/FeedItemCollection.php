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
     * @param string $routingName
     */
    public function add($item, $routingName)
    {
        $this->collection[] = array(
                                'item' => $item,
                                'route' => $routingName
                                );
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