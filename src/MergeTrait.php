<?php

namespace Kuleuven\Gbiomed\CollectionUtility;

use Doctrine\Common\Collections\Collection;

/**
 * Trait MergeTrait
 * @package Kuleuven\Gbiomed\CollectionUtility
 */
trait MergeTrait
{

    /**
     * Creates a new collection based on the current one and merges it with the given one.
     *
     * @param Collection $collection
     *
     * @return static|Collection
     */
    public function getMergedWith(Collection $collection)
    {
        return new static(
            array_merge($this->toArray(), $collection->toArray())
        );
    }

    /**
     * @return array
     */
    abstract public function toArray();

}