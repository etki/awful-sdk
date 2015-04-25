<?php

namespace Etki\AwfulSDK\Tests\Support\Providers;

use Iterator;

/**
 * Basic array wrapper.
 *
 * @version 0.1.0
 * @since   0.1.0
 * @package Etki\AwfulSDK\Tests\Support\Providers
 * @author  Etki <etki@etki.name>
 */
abstract class ArrayWrapper implements Iterator
{
    /**
     * Current key.
     *
     * @type int
     * @since 0.1.0
     */
    private $cursor = 0;
    /**
     * Data to provide.
     *
     * @type array
     * @since 0.1.0
     */
    private $data;
    /**
     * Data keys.
     *
     * @type array
     * @since 0.1.0
     */
    private $keys;

    /**
     * Sets data to provide.
     *
     * @param array $data Data to provide.
     *
     * @return $this Current instance.
     * @since 0.1.0
     */
    protected function setData(array $data)
    {
        $this->data = $data;
        $this->keys = array_keys($data);
        return $this;
    }

    /**
     * Tells if current key exists.
     *
     * @return bool
     * @since 0.1.0
     */
    public function valid()
    {
        return isset($this->keys[$this->cursor]);
    }

    /**
     * Resets iterator.
     *
     * @return void
     * @since 0.1.0
     */
    public function rewind()
    {
        $this->cursor = 0;
    }

    /**
     * Returns current element key.
     *
     * @return int|string
     * @since 0.1.0
     */
    public function key()
    {
        return $this->keys[$this->cursor];
    }

    /**
     * Returns current element.
     *
     * @return mixed
     * @since 0.1.0
     */
    public function current()
    {
        return $this->data[$this->key()];
    }

    /**
     * Moves iterator one step forward.
     *
     * @return void
     * @since 0.1.0
     */
    public function next()
    {
        $this->cursor++;
    }
}
