<?php

namespace Goodhanded\TriggerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class GoodhandedTriggerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (array_key_exists('events', $config))
        {
            $this->processTriggerConfig($config, $container);
        }
    }

    private function processTriggerConfig($config, $container)
    {
        $events = $config['events'];
        $epDefinition = $container->getDefinition('goodhanded_trigger.event_processor'); 

        foreach ($events as $event)
        {
            // Add event tag
            $epDefinition->addTag('kernel.event_listener', array(
                'event' => $event,
                'method' => 'onEvent',
            ));
        }

        // Add trigger configuration to the container        
        if (array_key_exists('triggers', $config))
            $container->setParameter('trigger.triggers', $config['triggers']);
    }

}
