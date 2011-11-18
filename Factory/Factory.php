<?php

namespace Funstaff\FeedBundle\Factory;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Funstaff\FeedBundle\Renderer\RendererInterface;

/**
 * Factory
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class Factory
{
    protected $config;

    protected $version;

    static protected $versions = array(
        '091', '092', '201', 'atom'
    );

    /**
     * Construct
     *
     * @param array $config
     */
    public function __construct(array $config, Router $router)
    {
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * Create Feed
     *
     * @param string $name
     * @param string $version
     *
     * @param feed
     */
    public function createFeed($name, $version = '201')
    {
        if (!array_key_exists($name, $this->config['channels'])) {
            throw new \InvalidArguementException('Invalid channel.');
        }

        if (!in_array($version, self::$versions)) {
            throw new \InvalidArgumentException('Invalid feed version.');
        }
        $keyname = $this->getKeyName($version);
        $class = $this->getClass($keyname);
        $renderer = $this->getRenderer($keyname);

        return new $class(
                        $this->config['channels'][$name],
                        new $renderer($this->router)
                    );
    }

    /**
     * Get Key Name
     *
     * @param string $version
     *
     * @return string feed name
     */
    protected function getKeyName($version)
    {
        return sprintf('feed%s', ucfirst($version));
    }

    /**
     * Get Class
     *
     * @param string $name
     *
     * @return string
     */
    protected function getClass($name)
    {
        if (!array_key_exists($name, $this->config['classes'])) {
            throw new \InvalidArgumentException('Invalid feed class');
        }

        return $this->config['classes'][$name];
    }

    /**
     * Get Renderer
     *
     * @param string $name
     *
     * @return string
     */
    protected function getRenderer($name)
    {
        if (!array_key_exists($name, $this->config['renderers'])) {
            throw new \InvalidArgumentException('Invalid feed class');
        }

        return $this->config['renderers'][$name];
    }
}