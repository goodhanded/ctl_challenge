<?php

namespace Goodhanded\PipelineBundle\Model;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class TrackerFactory implements ContainerAwareInterface  
{
	use ContainerAwareTrait;

	public function createTracker($dbDriver)
	{
		switch ($dbDriver) 
		{
			case 'doctrine_orm':
				return $this->container->get('goodhanded_pipeline.tracker.orm');
			default:
				throw new RuntimeException('Unsupported parameter value for pipeline_db_driver.');
		}
	}
}