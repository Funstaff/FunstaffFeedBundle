<?php

namespace Funstaff\FeedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 *
 * @author Bertrand Zuchuat <bertrand.zuchuat@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('funstaff_feed');

        $rootNode
            ->children()
                ->arrayNode('channels')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('title')->isRequired()->end()
                            ->scalarNode('description')->isRequired()->end()
                            ->scalarNode('link')->isRequired()->end()
                            ->scalarNode('language')->end()
                            ->scalarNode('copyright')->end()
                            ->scalarNode('managingEditor')->end()
                            ->scalarNode('webMaster')->end()
                            ->scalarNode('pubDate')->end()
                            ->scalarNode('lastBuildDate')->end()
                            ->scalarNode('category')->end()
                            ->scalarNode('generator')->defaultValue('FunstaffFeedBundle')->end()
                            ->scalarNode('docs')->end()
                            ->scalarNode('cloud')->end()
                            ->scalarNode('ttl')->end()
                            ->scalarNode('image')->end()
                            ->scalarNode('rating')->end()
                            ->scalarNode('textInput')->end()
                            ->scalarNode('skipHours')->end()
                            ->scalarNode('skipDays')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
