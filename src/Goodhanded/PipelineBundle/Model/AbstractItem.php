<?php

namespace Goodhanded\PipelineBundle\Model;

/**
 * Item.
 *
 * An abstract class representing a item to be tracked.
 * This class should be extended by an entity class for persistence.
 *
 * @author Keith Morris <keith.a.morris@gmail.com>
 */
abstract class AbstractItem implements ItemInterface
{

    /**
     * Item id
     *
     * @var mixed
     */
    protected $id;

    /**
     * Item name
     * 
     * @var string
     */
    protected $name;

    /**
     * Item count
     *
     * @var integer
     */
    protected $count;

    /**
     * @return mixed unique ID for this item
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * @return string name of the item
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string
     * @return null
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return integer total number of items in the item
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param integer
     * @return null
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

}