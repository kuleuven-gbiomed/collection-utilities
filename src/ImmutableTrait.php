<?php

namespace Kuleuven\Gbiomed\CollectionUtility;

/**
 * Trait ImmutableTrait
 * @package Kuleuven\Gbiomed\CollectionUtility
 */
trait ImmutableTrait
{

    /**
     * @param $element
     *
     * @return static
     */
    public function with($element)
    {

        $elements = $this->toArray();
        $elements[] = $element;

        return new static($elements);
    }

    /**
     * @param $element
     *
     * @return static
     */
    public function without($element)
    {

        $elements = $this->toArray();

        $key = array_search($element, $elements, true);

        if ($key === false) {
            return clone $this;
        }

        unset($elements[$key]);

        return new static($elements);

    }

    /**
     * @return array
     */
    abstract public function toArray();

}