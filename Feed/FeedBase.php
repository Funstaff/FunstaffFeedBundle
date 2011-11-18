<?php

namespace Funstaff\FeedBundle\Feed;

use Funstaff\FeedBundle\Feed\FeedInterface;
use Funstaff\FeedBundle\Feed\FeedItemCollection;
use Funstaff\FeedBundle\Feed\FeedItemInterface;
use Funstaff\FeedBundle\Renderer\RendererInterface;

/**
 * FeedBase
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class FeedBase implements FeedInterface
{
    protected $channel;

    protected $renderer;

    protected $collection;

    protected $title;

    protected $description;

    protected $link;

    protected $language;

    protected $copyright;

    protected $managingEditor;

    protected $webMaster;

    protected $pubDate;

    protected $lastBuildDate;

    protected $category;

    protected $generator;

    protected $docs;

    protected $cloud;

    protected $ttl;

    protected $image;

    protected $rating;

    protected $textInput;

    protected $skipHours;

    protected $skipDays;

    protected $encoding = 'UTF-8';

    /**
     * Construct
     *
     * @param array $channel
     */
    public function __construct($channel, RendererInterface $renderer)
    {
        $this->channel = $channel;
        $this->renderer = $renderer;
        $this->collection = new FeedItemCollection();
        $this->addInfos($channel);
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;
    }

    public function getCopyright()
    {
        return $this->copyright;
    }

    public function setManagingEditor($editor)
    {
        $this->managingEditor = $editor;
    }

    public function getManagingEditor()
    {
        return $this->managingEditor;
    }

    public function setWebMaster($webmaster)
    {
        $this->webMaster = $webmaster;
    }

    public function getWebMaster()
    {
        return $this->webMaster;
    }

    public function setPubDate($date)
    {
        $this->pubDate = $date;
    }

    public function getPubDate()
    {
        return $this->pubDate;
    }

    public function setLastBuildDate($date)
    {
        $this->lastBuildDate = $date;
    }

    public function getLastBuildDate()
    {
        return $this->lastBuildDate;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setGenerator($generator)
    {
        $this->generator = $generator;
    }

    public function getGenerator()
    {
        return $this->generator;
    }

    public function setDocs($docs)
    {
        $this->docs = $docs;
    }

    public function getDocs()
    {
        return $this->docs;
    }

    public function setCloud($cloud)
    {
        $this->cloud = $cloud;
    }

    public function getCloud()
    {
        return $this->cloud;
    }

    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    public function getTtl()
    {
        return $this->ttl;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setTextInput($textInput)
    {
        $this->textInput = $textInput;
    }

    public function getTextInput()
    {
        return $this->textInput;
    }

    public function setSkipHours($skipHours)
    {
        $this->skipHours = $skipHours;
    }

    public function getSkipHours()
    {
        return $this->skipHours;
    }

    public function setSkipDays($skipDays)
    {
        $this->skipDays = $skipDays;
    }

    public function getSkipDays()
    {
        return $this->skipDays;
    }

    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    }

    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Add Item
     *
     * @param ItemInterface $item
     *
     * @return $this
     */
    public function addItem(FeedItemInterface $item)
    {
        $this->collection->add($item);

        return $this;
    }

    /**
     * Add Items
     *
     * @param array $items
     *
     * @return $this
     */
    public function addItems($items)
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    public function render()
    {
        return $this->renderer->render($this, $this->version);
    }

    protected function addInfos($channel)
    {
        foreach ($channel as $key => $value) {
            $command = 'set'.ucfirst($key);
            $this->$command($value);
        }
    }
}