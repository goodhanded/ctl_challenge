<?php

namespace Goodhanded\TriggerBundle\Service;

use Symfony\Component\EventDispatcher\Event;

class EventPropertyMapper
{
	private $extractor;
	private $event;

	public function __construct(ObjectPropertyExtractor $extractor)
	{
		$this->extractor = $extractor;
	}

	public function map(Event $event, array $properties)
	{
		$this->event = $event;
		$callback = function ($key) {
			$value = $this->extractor->extractProperty($key, $this->event);
			$properties[$key] = $value;
		};
		return array_map($callback, $properties);
	}
}