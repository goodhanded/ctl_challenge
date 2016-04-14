<?php

namespace Goodhanded\PipelineBundle\Model;

/**
 * TrackerInterface.
 *
 * Any Tracker class must implement this interface.
 *
 * @author Keith Morris <keith.a.morris@gmail.com>
 */
interface TrackerInterface
{

    /**
     * @param string $name
     * @param integer $count
     * @return string error message
     */
    public function track($name, $count);

}