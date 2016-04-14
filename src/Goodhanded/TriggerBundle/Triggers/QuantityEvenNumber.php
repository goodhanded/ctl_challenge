<?php

namespace Goodhanded\TriggerBundle\Triggers;

use Goodhanded\TriggerBundle\Triggers\TriggerInterface;
use Goodhanded\TriggerBundle\Exception\TriggerPropertyNotFoundException;

class QuantityEvenNumber implements TriggerInterface
{

	public function validate(array $properties)
	{
		if (!array_key_exists('quantity', $properties)) {
			throw new TriggerPropertyNotFoundException($this, "Quantity property is missing.");
		}
		
		return ($properties['quantity'] % 2 == 0);
	}

}