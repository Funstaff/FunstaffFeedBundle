<?php

namespace Funstaff\FeedBundle\Tests\Feed;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Funstaff\FeedBundle\Feed\FeedItemEnclosure;

/**
 * FeedItemEnclosureTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemEnclosureTest extends TestCase
{
    public function setup()
    {
        $this->feed = new FeedItemEnclosure();
    }

    public function testUrl()
    {
        $this->assertNull($this->feed->getUrl());
        $this->feed->setUrl('http://foo/bar');
        $this->assertEquals('http://foo/bar', $this->feed->getUrl());
    }

    public function testLength()
    {
        $this->assertEquals(0, $this->feed->getLength());
        $this->feed->setLength(12345);
        $this->assertEquals(12345, $this->feed->getLength());
    }

    public function testType()
    {
        $this->assertNull($this->feed->getType());
        $this->feed->setType('audio/mpeg');
        $this->assertEquals('audio/mpeg', $this->feed->getType());
    }
}