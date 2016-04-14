<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Goodhanded\PipelineBundle\Entity\Item as BaseTracker;
/**
 * Tracker
 *
 * @ORM\Table(name="tracker")
 * @ORM\Entity
 */
class Tracker extends BaseTracker
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    protected $count;

}

