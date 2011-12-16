<?php

namespace Funstaff\FeedBundle\Tests\Feed;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Funstaff\FeedBundle\Feed\FeedItemSource;

/**
 * FeedItemSourceTest
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedItemSourceTest extends TestCase
{
    protected $feed;

    public function setup()
    {
        $this->feed = new FeedItemSource();
    }

    public function testTitle()
    {
        $this->assertNull($this->feed->getTitle());
        $this->feed->setTitle('Foo');
        $this->assertEquals('Foo', $this->feed->getTitle());
    }

    public function testUrl()
    {
        $this->assertNull($this->feed->getUrl());
        $this->feed->setUrl('http://foo/bar');
        $this->assertEquals('http://foo/bar', $this->feed->getUrl());
    }
}