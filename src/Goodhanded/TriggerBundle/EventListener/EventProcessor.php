<?php

namespace Goodhanded\TriggerBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\EventDispatcher\Event;

class EventProcessor implements ContainerAwareInterface  
{
	use ContainerAwareTrait;

	private $event;

	public function onEvent(Event $event)
	{
		$this->event = $event;

		// Get list of registered triggers.
		$triggers = $this->container->getParameter('trigger.triggers');

		// Process individual item triggers.
		if (array_key_exists('item_specific', $triggers))
			foreach($triggers['item_specific'] as $item => $config)
				$this->processItemTrigger($item, $config);

		// Process "all item" triggers.
		if (array_key_exists('all_items', $triggers))
			foreach($triggers['all_items'] as $config)
				$this->fireTrigger($config);

	}

	private function processItemTrigger($item, $config)
	{

		// The name of this item_specific trigger has to match a property in the event.
		$extractor = $this->container->get('goodhanded_trigger.object_property_extractor');
		$match = $extractor->extractProperty($config['match'], $this->event); 
			
		// Only fire trigger if the event matches.
		if($item == $match)
			$this->fireTrigger($config);

	}

	private function fireTrigger($config)
	{
		// Extract needed properties from the event.
		$mapper = $this->container->get('goodhanded_trigger.event_property_mapper');
		$properties = $config['properties'];
		$propertiesArray = $mapper->map($this->event, $properties);

		// Validate trigger condition
		$triggerServiceName = $config['trigger'];
		$trigger = $this->container->get($triggerServiceName);

		if($trigger->validate($propertiesArray))
		{
			// Take action
			$actionService = $this->container->get($config['action']);
			$actionService->act($this->event);
		}
	}

}