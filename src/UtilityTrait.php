<?php

namespace Kuleuven\Gbiomed\CollectionUtility;

/**
 * Trait UtilityTrait
 *
 * Groups useful traits and methods not dependent on specific type of elements in a collection.
 *
 * @package Kuleuven\Gbiomed\CollectionUtility
 */
trait UtilityTrait
{

    /**
     * Allows to merge collections together.
     */
    use MergeTrait;

    /**
     * Allows to create new collections based on the old ones.
     */
    use ImmutableTrait;

    /**
     * Allows to get, remove or check for duplicates in a collection.
     */
    use DeduplicationTrait;

    /**
     * Allows to directly map collections to array.
     */
    use MapToArrayTrait;

    /**
     * Execute given closure for each element of the collection.
     *
     * @param \Closure $closure Closure to execute. Will receive element as an argument.
     */
    public function each(\Closure $closure)
    {
        foreach ($this->toArray() as $element) {
            $closure($element);
        }
    }

    /**
     * Check whether the collection contains element indicated by closure.
     *
     * @param \Closure $closure Must return true for the searched element. False otherwise.
     *
     * @return bool Whether the collection contains element indicated by closure.
     */
    public function has(\Closure $closure)
    {
        foreach ($this->toArray() as $element) {
            if ($closure($element)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Returns the only element in the collection. Throws exception if collection has more or less than one element.
     *
     * @return mixed
     * @throws \BadMethodCallException
     */
    public function getOne()
    {
        if ($this->count() !== 1) {
            throw new \BadMethodCallException(
                "The only one element requested from collection, however collection has {$this->count()} elements!"
            );
        }

        return $this->first();
    }

    /**
     * Check whether collection is not empty.
     *
     * This is just a syntax sugar. Negation on the beginning of a sentence feels weird. Eg.:
     *
     * "if(!$collection->isEmpty()) { ... }" can be read as "If not collection is empty..."
     *
     * This sound way much better:
     *
     * "if($collection->isNotEmpty()) { ... }" or "If collection is not empty..."
     *
     * Warning!
     *
     * Don't try to build constructions like "if(!$collection->isNotEmpty()) { ... }". This is just plain WRONG!
     *
     * @return bool
     */
    public function isNotEmpty()
    {
        return !$this->isEmpty();
    }

    /**
     * @return bool
     */
    public function hasElements()
    {
        return $this->count() ? true : false;
    }

    /**
     * @return bool
     */
    abstract public function isEmpty();
}
