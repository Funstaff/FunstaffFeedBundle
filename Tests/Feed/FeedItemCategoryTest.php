<?php

namespace Funstaff\FeedBundle\Tests\Feed;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Funstaff\FeedBundle\Feed\FeedItemCategory;

/**
 * FeedItemCategoryTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemCategoryTest extends TestCase
{
    public function setup()
    {
        $this->feed = new FeedItemCategory();
    }

    public function testCategory()
    {
        $this->assertNull($this->feed->getCategory());
        $this->feed->setCategory('Foo');
        $this->assertEquals('Foo', $this->feed->getCategory());
    }

    public function testDomain()
    {
        $this->assertNull($this->feed->getDomain());
        $this->feed->setDomain('bar.com');
        $this->assertEquals('bar.com', $this->feed->getDomain());
    }
}