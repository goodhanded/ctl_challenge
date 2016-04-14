<?php

namespace Goodhanded\PipelineBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Goodhanded\PipelineBundle\Model\ItemInterface;

/**
 * A tracking event.
 *
 * @author Keith Morris <keith.a.morris@gmail.com>
 */
class TrackEvent extends Event
{
    const NAME = 'tracker.updated';

    private $item;
    private $changed;

    /**
     * Constructs an event.
     *
     * @param \Goodhanded\PipelineBundle\Model\ItemInterface $item
     */
    public function __construct(ItemInterface $item, $changed)
    {
        $this->item = $item;
        $this->changed = $changed;
    }

    /**
     * Returns the item for this event.
     *
     * @return \Goodhanded\PipelineBundle\Model\ItemInterface
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Returns the amount the item was changed.
     *
     * @return integer
     */
    public function getChanged()
    {
        return $this->changed;
    }

}