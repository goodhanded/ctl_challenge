<?php

namespace Goodhanded\TriggerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('goodhanded_trigger')
            ->children()
                ->arrayNode('events')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('triggers')
                    ->children()
                        ->arrayNode('item_specific')
                            ->useAttributeAsKey('item')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('match')->end()
                                    ->scalarNode('trigger')->end()
                                    ->arrayNode('properties')
                                        ->useAttributeAsKey('key')
                                        ->prototype('scalar')->end()
                                    ->end()
                                    ->scalarNode('action')->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('all_items')
                            ->useAttributeAsKey('item')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('match')->end()
                                    ->scalarNode('trigger')->end()
                                    ->arrayNode('properties')
                                        ->useAttributeAsKey('key')
                                        ->prototype('scalar')->end()
                                    ->end()
                                    ->scalarNode('action')->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
