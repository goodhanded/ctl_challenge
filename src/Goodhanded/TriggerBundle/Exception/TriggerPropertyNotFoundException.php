<?php

namespace Goodhanded\TriggerBundle\Exception;

class TriggerPropertyNotFoundException extends TriggerException
{
    public function __construct(TriggerInterface $trigger, $message = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct($trigger, $message, $previous, $code);
    }
}
