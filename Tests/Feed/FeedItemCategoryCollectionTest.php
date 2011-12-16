<?php

namespace Funstaff\FeedBundle\Tests\Feed;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Funstaff\FeedBundle\Feed\FeedItemCategory;
use Funstaff\FeedBundle\Feed\FeedItemCategoryCollection;

/**
 * FeedItemCategoryCollectionTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemCategoryCollectionTest extends TestCase
{
    public function setup()
    {
        $this->feed = new FeedItemCategoryCollection();
    }

    public function testCollection()
    {
        $this->assertNull($this->feed->get());
        $this->feed->add($this->getFeedItemCategory(1));
        $this->assertEquals(1, count($this->feed->get()));
        $this->feed->add($this->getFeedItemCategory(2));
        $this->feed->add($this->getFeedItemCategory(3));
        $this->assertEquals(3, count($this->feed->get()));

        $collection = $this->feed->get();
        $this->assertEquals('Foo 2', $collection[1]->getCategory());
    }

    private function getFeedItemCategory($id)
    {
        $c = new FeedItemCategory();
        $c->setCategory('Foo '.$id);

        return $c;
    }
}