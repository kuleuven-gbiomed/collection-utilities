<?php

namespace Kuleuven\Gbiomed\CollectionUtility;

/**
 * Trait MapToArrayTrait
 * @package Kuleuven\Gbiomed\CollectionUtility
 */
trait MapToArrayTrait
{

    /**
     * Maps collection to an array(instead of a new collection).
     *
     * @param callable $callback
     *
     * @return array
     */
    public function mapToArray(callable $callback)
    {
        return array_map($callback, $this->toArray());
    }

    /**
     * Allows to map collection to many arrays that are merged together.
     *
     * Example:
     * Assume that you have collection of parents and you want to get list of all children's of the parents.
     * Each parent can have many children and all children's need to be merged into one list.
     *
     * Waring! You may want to make sure that the list contains only unique items.
     *
     * @param callable $callback Important! Must return an array.
     *
     * @return array
     */
    public function mapAndMergeToArray(callable $callback)
    {
        $mapToArray = $this->mapToArray($callback);

        if (empty($mapToArray)) {
            return [];
        }

        return array_merge(...$mapToArray);
    }

    /**
     * @return array
     */
    abstract public function toArray();

}