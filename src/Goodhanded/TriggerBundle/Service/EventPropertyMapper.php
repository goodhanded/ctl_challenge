<?php

namespace Goodhanded\TriggerBundle\Service;

use Symfony\Component\EventDispatcher\Event;

class EventPropertyMapper
{
	private $extractor;

	public function __construct(ObjectPropertyExtractor $extractor)
	{
		$this->extractor = $extractor;
	}

	public function map(Event $event, array $properties)
	{
		foreach ($properties as $property => $map) {
			$properties[$property] = $this->extractor->extractProperty($map, $event);
		}

		return $properties;
	}
}