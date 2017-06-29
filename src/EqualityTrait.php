<?php

namespace Kuleuven\Gbiomed\CollectionUtility;

use Doctrine\Common\Collections\Collection;

/**
 * Trait EqualityTrait
 * @package Kuleuven\Gbiomed\CollectionUtility
 */
trait EqualityTrait
{
    /**
     * @return array
     */
    abstract public function toArray();

    /**
     * compare collection instance with a given ArrayCollection
     *
     * @param Collection $collection
     *
     * @return bool
     */
    public function equals(Collection $collection)
    {
        $sourceArray = $this->toArray();
        $givenArray = $collection->toArray();

        // check size of both arrays
        if (count($sourceArray) !== count($givenArray)) {
            return false;
        }

        foreach ($givenArray as $key => $givenValue) {

            // check that expected value exists in the array
            if (!in_array($givenValue, $sourceArray, true)) {
                return false;
            }

            // check that expected value occurs the same amount of times in both arrays
            if (count(array_keys($sourceArray, $givenValue, true)) !== count(array_keys($givenArray, $givenValue, true))) {
                return false;
            }

        }

        return true;
    }
}