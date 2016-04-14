<?php

namespace Goodhanded\PipelineBundle\Entity;

use Doctrine\ORM\EntityManager;
use Goodhanded\PipelineBundle\Model\AbstractTracker;
use Goodhanded\PipelineBundle\Event\TrackEvent;

class Tracker extends AbstractTracker
{

	protected $em;

	public function __construct (EntityManager $em)
	{
		$this->em = $em;
	}

	public function track ($name, $count) 
	{
		$item = $this->em->getRepository($this->itemClass)->findOneByName($name);

		if (!$item) 
		{
			$item = new $this->itemClass;
			$item->setName($name);
			$item->setCount($count);
			$this->em->persist($item);
		} 
		else 
		{
			$oldCount = $item->getCount();
			$item->setCount($oldCount + $count);
		}

		$this->em->flush();

		$trackEvent = new TrackEvent($item, $count);
		$this->dispatcher->dispatch(TrackEvent::NAME, $trackEvent);
	}

}