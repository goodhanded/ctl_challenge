<?php

namespace Goodhanded\TriggerBundle\Triggers;

interface TriggerInterface
{
	public function validate(array $properties);
}