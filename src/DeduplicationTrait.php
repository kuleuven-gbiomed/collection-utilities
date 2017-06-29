<?php

namespace Kuleuven\Gbiomed\CollectionUtility;

/**
 * Class DeduplicationTrait
 *
 * @see     http://php.net/manual/en/function.array-unique.php
 * @see     http://php.net/manual/en/function.in-array.php
 *
 * Strict/weak object comparison:
 * @see     http://php.net/manual/en/language.oop5.object-comparison.php
 * @package Kuleuven\Gbiomed\CollectionUtility
 */
trait DeduplicationTrait
{

    /**
     * Returns collection with unique elements.
     *
     * Why not just array_unique? Because array_unique strict comparison converts elements to strings.
     * If you don't want to implement and relay on ::__toString() magic, this is the way to go.
     *
     * @param bool $strict (optional) Strict by default.
     *
     * @return static
     */
    public function getUnique($strict = true)
    {
        $elements = $this->toArray();

        $uniqueElements = [];
        foreach ($elements as $key => $element) {

            // check whether element is a duplicate
            if (!in_array($element, $uniqueElements, $strict)) {
                $uniqueElements[$key] = $element; // preserve the first encountered key (follows array_unique behaviour)
            }

        }

        return new static($uniqueElements);
    }

    /**
     * Returns collection with all duplicated elements. Notice that only the second and all following occurrences of an
     * duplicated element are returned, the first one is not, because it's not considered a duplicate.
     *
     * @param bool $strict (optional) Strict by default.
     *
     * @return static
     */
    public function getDuplicates($strict = true)
    {
        $elements = $this->toArray();

        $duplicates = [];
        $uniqueElements = [];
        foreach ($elements as $key => $element) {

            // check whether element is a duplicate
            if (!in_array($element, $uniqueElements, $strict)) {
                $uniqueElements[$key] = $element; // save all first occurrences of an element
            } else {
                $duplicates[$key] = $element; // save all duplicates
            }

        }

        return new static($duplicates);
    }

    /**
     * Checks whether collection has duplicated elements.
     *
     * @param bool $strict (optional) Strict by default.
     *
     * @return bool
     */
    public function hasDuplicates($strict = true)
    {
        $elements = $this->toArray();

        $alreadyCheckedElements = [];
        foreach ($elements as $element) {

            // check whether element is a duplicate
            if (in_array($element, $alreadyCheckedElements, $strict)) {
                return true;
            }

            $alreadyCheckedElements[] = $element;

        }

        return false;
    }

    /**
     * @return array
     */
    abstract public function toArray();

}