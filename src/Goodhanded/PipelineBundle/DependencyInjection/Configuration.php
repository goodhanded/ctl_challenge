<?php

namespace Goodhanded\PipelineBundle\DependencyInjection;

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
        $treeBuilder->root('goodhanded_pipeline')
            ->children()
                ->enumNode('db_driver')
                    ->info('This is the persistence method.')
                    ->values(array(
                        'doctrine_orm',
                        'doctrine_odm'
                    ))
                    ->defaultValue('doctrine_orm')
                ->end()
                ->scalarNode('item_class')
                    ->info('The full path to your mapped Item class.')
                    ->isRequired()
                    ->end()
            ->end();

        return $treeBuilder;
    }
}
