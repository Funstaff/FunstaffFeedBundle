<?php

namespace Funstaff\FeedBundle\Renderer;

use Funstaff\FeedBundle\Renderer\RendererBase;
use Funstaff\FeedBundle\Renderer\RendererInterface;
use Funstaff\FeedBundle\Feed\FeedInterface;

/**
 * RendererRss
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class RendererRss extends RendererBase implements RendererInterface
{
    public function render(FeedInterface $feed, $version)
    {
        $base = sprintf(
                    '<?xml version="1.0" encoding="%s"?><rss></rss>',
                    $feed->getEncoding()
                );

        $element = new \SimpleXmlElement($base);
        $element->addAttribute('version', $version);

        /* Add Header informations */
        foreach ($feed->getChannel() as $key => $value) {
            switch($key) {
                case 'category':
                    if (is_array($value) && count($value) > 0) {
                        foreach ($value as $category) {
                            $element->addChild($key, $category);
                        }
                    }
                break;

                case 'cloud':
                    if (is_array($value)) {
                        $node = $element->addChild($key);
                        foreach ($value as $k => $v) {
                            $node->addAttribute($k, $v);
                        }
                    }
                break;

                default:
                    $element->addChild($key, $value);
                break;
            }
        }

        /* Add Item */
        foreach ($feed->getCollection()->get() as $record) {
            $item = $record['item'];
            $route = $record['route'];
            $node = $element->addChild('item');
            $node->addChild('title', $item->getFeedTitle());
            $node->addChild('description', $item->getFeedDescription());
            $node->addChild('link', $this->router->generate($route, $item->getFeedLink()));

            $rc = new \ReflectionClass($item);

            if ($rc->hasMethod('getFeedCategory')) {
                foreach ($item->getFeedCategory() as $category) {
                    $node->addChild('category', $item->getFeedCategory());
                }
            }

            if ($rc->hasMethod('getFeedEnclosure')) {
                $attributes = $item->getFeedEnclosure();
                $enclosure = $node->addChild('enclosure');
                foreach ($attributes as $key => $value) {
                    $enclosure->addAttribute($key, $value);
                }
            }

            if ($rc->hasMethod('getFeedGuid')) {
                $content = $item->getFeedGuid();
                if (is_array($content)) {
                    $guid = $node->addChild('guid', $content['value']);
                    $guid->addAttribute('isPermaLink', $content['isPermaLink']);
                } else {
                    $node->addChild('guid', $content);
                }
            }

            if ($rc->hasMethod('getFeedSource')) {
                $content = $item->getFeedSource();
                if (is_array($content)) {
                    $source = $node->addChild('source', $content['value']);
                    $source->addAttribute('url', $content['url']);
                } else {
                    $node->addChild('guid', $content);
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

        return $element->asXml();
    }
}