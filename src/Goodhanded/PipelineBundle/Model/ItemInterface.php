<?php

namespace Goodhanded\PipelineBundle\Model;

/**
 * ItemInterface.
 *
 * Any item to be tracked by Goodhanded\PipelineBundle must implement this interface.
 *
 * @author Keith Morris <keith.a.morris@gmail.com>
 */
interface ItemInterface
{

    /**
     * @return mixed unique ID for this item
     */
    public function getId();

    /**
     * @return string name of the item
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return integer total number of items in the item
     */
    public function getCount();

    /**
     * @param integer $count
     */
    public function setCount($count);
}