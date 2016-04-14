<?php

namespace Goodhanded\TriggerBundle\Actions;

use Symfony\Component\EventDispatcher\Event;

interface ActionInterface
{
	public function act(Event $event);
}