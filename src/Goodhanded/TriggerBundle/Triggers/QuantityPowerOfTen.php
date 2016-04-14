<?php

namespace Goodhanded\TriggerBundle\Triggers;

use Goodhanded\TriggerBundle\Triggers\TriggerInterface;
use Goodhanded\TriggerBundle\Exception\TriggerPropertyNotFoundException;

class QuantityPowerOfTen implements TriggerInterface
{

	public function validate(array $properties)
	{

		if (!array_key_exists('quantity', $properties)) {
			throw new TriggerPropertyNotFoundException($this, "Quantity property is missing.");
		}

		$quantity = $properties['quantity'];

		if ($quantity == 0) {
			return false;
		}

		while ($quantity % 10 == 0) {
		    $quantity /= 10;
		}

		return $quantity == 1;
	}

}