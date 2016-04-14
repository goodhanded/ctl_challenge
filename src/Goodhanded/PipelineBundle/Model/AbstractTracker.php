<?php

namespace Goodhanded\PipelineBundle\Model;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

abstract class AbstractTracker implements TrackerInterface
{

	/**
	 * @var EventDispatcherInterface
	 */
	protected $dispatcher;
	protected $itemClass;

	public function setDispatcher(EventDispatcherInterface $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}

	public function setItemClass($itemClass)
	{
		$this->itemClass = $itemClass;
	}

}