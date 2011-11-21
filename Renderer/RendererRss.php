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
    protected static $fields = array(
        'author', 'category', 'comments', 'enclosure',
        'guid', 'pubDate', 'source'
    );

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
            $element->addChild($key, $value);
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
            foreach (static::$fields as $field) {
                $function = sprintf('getFeed%s', ucfirst($field));
                if ($rc->hasMethod($function)) {
                    $node->addChild($field, $item->$function());
                }
            }
        }

        return $element->asXml();
    }
}