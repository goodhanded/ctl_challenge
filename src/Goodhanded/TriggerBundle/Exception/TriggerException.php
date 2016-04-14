<?php

namespace Goodhanded\TriggerBundle\Exception;

use Goodhanded\TriggerBundle\Triggers\TriggerInterface;

class TriggerException extends \RuntimeException
{
    private $trigger;

    public function __construct(TriggerInterface $trigger, $message = null, \Exception $previous = null, $code = 0)
    {
        $this->trigger = $trigger;
        parent::__construct($message, $code, $previous);
    }

    public function getTrigger()
    {
        return $this->trigger;
    }

}
