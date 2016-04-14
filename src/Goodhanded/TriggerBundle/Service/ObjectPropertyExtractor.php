<?php

namespace Goodhanded\TriggerBundle\Service;

use Symfony\Component\EventDispatcher\Event;

class ObjectPropertyExtractor
{

	public function extractProperty($property, $rootObject)
	{
		$getters = explode('.', $property);

		// Reduce callback to convert 'item.example.name' to $event->getItem()->getExample()->getName()
		$callback = function($carry, $item) {
			$currentObject = $carry;
			$getter = 'get' . ucwords($item);
			return $currentObject->$getter();
		};

		return array_reduce($getters, $callback, $rootObject);
	}

}