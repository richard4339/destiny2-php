<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @author Toni Peric
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-24 12:16 CDT by richard
 *
 * Based on the AbstractResource Class from Toni Peric
 *
 * The MIT License (MIT)
 *
 * Copyright (c) 2016 Toni Perić
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace Destiny;

/**
 * Class AbstractResource
 * @package Destiny
 *
 * @method postMakeFromArray()
 */
abstract class AbstractResource
{
    protected $data = [];
    protected $casts = [];

    const TIMEZONE = 'GMT';

    /**
     * AbstractResource constructor.
     */
    function __construct()
    {

    }

    /**
     * @param array $properties
     * @return static
     */
    public static function makeFromArray(array $properties)
    {
        $instance = new static;

        $instance->parseProperties($properties);

        // Callback-style function to perform actions after all properties have been passed
        $instance->postMakeFromArray();

        return $instance;
    }

    /**
     * @param array $properties
     */
    protected function parseProperties(array $properties)
    {
        foreach ($properties as $key => $value) {
            $this->parse($key, $value);
        }
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return mixed
     */
    protected function parse($key, $value)
    {
        if ($this->isCastable($key)) {
            return $this->cast($key, $value);
        }

        return $this->setRawProperty($key, $value);
    }

    /**
     * @param $key
     * @return bool
     */
    protected function isCastable($key)
    {
        return array_key_exists($key, $this->casts) || is_int($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function cast($key, $value)
    {
        $class = is_int($key) ? $this->casts['all'] : $this->casts[$key];

        return $this->setRawProperty($key, $class::makeFromArray($value));
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function setRawProperty($key, $value)
    {
        $this->data[$key] = $value;

        // Automatically set the class variable if it exists
        if (property_exists(static::class, $key)) {
            $this->$key = $value;
        }

        return $this;
    }

    /**
     * @param mixed|null $key
     * @param mixed|null $default
     * @return array|mixed|null
     */
    protected function get($key = null, $default = null)
    {
        if ($key === null) {
            return $this->data ?? $default;
        }

        return $this->data[$key] ?? $default;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return array|mixed|null
     */
    public function __call($name, $arguments)
    {
        if($data = $this->get($name))
        {
            return $data;
        }
    }
}