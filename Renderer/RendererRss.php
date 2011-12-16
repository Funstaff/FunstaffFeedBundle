<?php

namespace Funstaff\FeedBundle\Renderer;

use Funstaff\FeedBundle\Renderer\RendererBase;
use Funstaff\FeedBundle\Renderer\RendererInterface;
use Funstaff\FeedBundle\Feed\FeedInterface;
use Funstaff\FeedBundle\Feed\FeedItemCategory;
use Funstaff\FeedBundle\Feed\FeedItemCategoryCollection;
use Funstaff\FeedBundle\Feed\FeedItemEnclosure;
use Funstaff\FeedBundle\Feed\FeedItemGuid;
use Funstaff\FeedBundle\Feed\FeedItemSource;

/**
 * RendererRss
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RendererRss extends RendererBase implements RendererInterface
{
    /**
     * Render
     * 
     * @param FeedInterface $feed;
     * @param string $version;
     * 
     * @return string xml
     */
    public function render(FeedInterface $feed, $version)
    {
        $base = sprintf(
                    '<?xml version="1.0" encoding="%s"?><rss></rss>',
                    $feed->getEncoding()
                );

        $element = new \SimpleXmlElement($base);
        $element->addAttribute('version', $version);

        $element = $this->setChannelInformation($feed, $element);
        $element = $this->setItemInformation($feed, $element);

        return $element->asXml();
    }

    /**
     * Set Channel Information
     * 
     * @param FeedInterface $feed
     * @param SimpleXml $element
     * 
     * @return SimpleXml
     */
    public function setChannelInformation($feed, $element)
    {
        /* Add Header informations */
        foreach ($feed->getChannel() as $key => $value) {
            switch($key) {
                case 'category':
                case 'textInput':
                    if (is_array($value) && count($value) > 0) {
                        $this->populateChild($element, $key, $value);
                    }
                break;

                case 'cloud':
                case 'image':
                    if (is_array($value) && count($value) > 0) {
                        $this->populateAttribute($element, $key, $value);
                    }
                break;

                default:
                    $element->addChild($key, $value);
                break;
            }
        }

        return $element;
    }

    /**
     * Set Item Information
     * 
     * @param FeedInterface $feed
     * @param SimpleXml $element
     * 
     * @return SimpleXml
     */
    public function setItemInformation($feed, $element)
    {
        /* Add Item */
        foreach ($feed->getCollection()->get() as $record) {
            $item = $record['item'];
            $route = $record['route'];
            $node = $element->addChild('item');
            $node->addChild('title', $item->getFeedTitle());
            $node->addChild('description', $item->getFeedDescription());
            $node->addChild('link', $this->router->generate($route, $item->getFeedLink()));

            $rc = new \ReflectionClass($item);

            /* Category */
            if ($rc->hasMethod('getFeedCategory')) {
                $category = $item->getFeedCategory();
                if ($category instanceOf FeedItemCategory) {
                    $cat = $node->addChild('category', $category->getCategory());
                    if (null != $category->getDomain()) {
                        $cat->addAttribute('domain', $category->getDomain());
                    }
                }

                if ($category instanceOf FeedItemCategoryCollection) {
                    foreach ($category as $fcategory) {
                        $cat = $node->addChild('category', $fcategory->getCategory());
                        if (null != $fcategory->getDomain()) {
                            $cat->addAttribute('domain', $fcategory->getDomain());
                        }
                    }
                }
            }

            /* Enclosure */
            if ($rc->hasMethod('getFeedEnclosure')) {
                $enclosure = $item->getFeedEnclosure();
                if ($enclosure instanceOf FeedItemEnclosure) {
                    $enc = $node->addChild('enclosure');
                    $enc->addAttribute('url', $enclosure->getUrl());
                    $enc->addAttribute('length', $enclosure->getLength());
                    $enc->addAttribute('type', $enclosure->getType());
                }
            }

            /* Guid */
            if ($rc->hasMethod('getFeedGuid')) {
                $guid = $item->getFeedGuid();
                if ($guid instanceOf FeedItemGuid) {
                    $gu = $node->addChild('guid', $guid->getLink());
                    if ($guid->isPermalink()) {
                        $gu->addAttribute('isPermaLink', $guid->isPermalink());
                    }
                }
            }

            /* Source */
            if ($rc->hasMethod('getFeedSource')) {
                $source = $item->getFeedSource();
                if ($source instanceOf FeedItemSource) {
                    $so = $node->addChild('source', $source->getTitle());
                    $so->addAttribute('url', $source->getUrl());
                }
            }

            foreach (array(
                'author',
                'comments',
                'pubDate') as $field) {
                $function = sprintf('getFeed%s', ucfirst($field));
                if ($rc->hasMethod($function)) {
                    $node->addChild($field, $item->$function());
                }
            }
        }

        return $element;
    }
}