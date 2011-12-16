<?php

namespace Funstaff\FeedBundle\Tests\Feed;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Funstaff\FeedBundle\Feed\FeedItemGuid;

/**
 * FeedItemGuidTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemGuidTest extends TestCase
{
    public function setup()
    {
        $this->feed = new FeedItemGuid();
    }

    public function testLink()
    {
        $this->assertNull($this->feed->getLink());
        $this->feed->setLink('http://foo/bar');
        $this->assertEquals('http://foo/bar', $this->feed->getLink());
    }

    public function testIsPermalink()
    {
        $this->assertFalse($this->feed->isPermalink());
        $this->feed->setIsPermalink(true);
        $this->assertTrue($this->feed->isPermalink());
    }
}