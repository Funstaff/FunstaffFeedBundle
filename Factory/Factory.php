<?php

namespace Funstaff\FeedBundle\Factory;

/**
 * Factory
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class Factory
{
    protected $config;

    static protected $versions = array(
        '091', '092', '201', 'atom'
    );

    /**
     * Construct
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
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

        $class = sprintf('feed%s', ucfirst($version));
        if (!array_key_exists($class, $this->config['classes'])) {
            throw new \InvalidArgumentException('Invalid feed class');
        }
        $feed = $this->config['classes'][$class];

        return new $feed($this->config['channels'][$name]);
    }
}