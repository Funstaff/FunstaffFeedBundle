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
                ->arrayNode('classes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('feed091')
                            ->defaultValue('Funstaff\FeedBundle\Feed\Feed091')
                        ->end()
                        ->scalarNode('feed092')
                            ->defaultValue('Funstaff\FeedBundle\Feed\Feed092')
                        ->end()
                        ->scalarNode('feed201')
                            ->defaultValue('Funstaff\FeedBundle\Feed\Feed201')
                        ->end()
                        ->scalarNode('feedAtom')
                            ->defaultValue('Funstaff\FeedBundle\Feed\FeedAtom')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
