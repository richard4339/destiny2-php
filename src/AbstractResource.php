<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @author Toni Peric
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
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

use DateTime;
use DateTimeZone;

/**
 * Class AbstractResource
 * @package Destiny
 *
 * @method postMakeFromArray()
 */
abstract class AbstractResource
{

    /**
     * @var array Holds all data
     */
    protected $data = [];

    /**
     * @var array Array of columns that will need to be casted to their own class
     * Example: ['property' => SomeClass::class]
     */
    protected $casts = [];

    /**
     * @var array Array of columns that will need to be casted to their own class (as an array)
     * Example: ['property' => SomeClass::class]
     *
     * @since 0.2.2
     */
    protected $arrays = [];

    /**
     * @var string[] Array of string columns that will need to be converted to dates using getDateTime() in lieu of get()
     */
    protected $dates = [];

    /**
     * @var array Array of columns that can be cast to an enum type
     * Example: ['property' => SomeEnum::class]
     */
    protected $enums = [];

    /**
     * @var string Default TimeZone to return data in
     *
     * @since 0.2.2
     */
    protected $timezone = 'UTC';

    /**
     * AbstractResource constructor.
     */
    function __construct()
    {

    }

    /**
     * Converts the response into an array
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
     * Parses the properties
     * @param array $properties
     */
    protected function parseProperties(array $properties)
    {
        foreach ($properties as $key => $value) {
            $this->parse($key, $value);
        }
    }

    /**
     * Parse out castable keys
     *
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
     * Is the key castable?
     *
     * @param $key
     * @return bool
     */
    protected function isCastable($key)
    {
        return array_key_exists($key, $this->casts) || array_key_exists($key, $this->arrays) || is_int($key);
    }

    /**
     * Cast the key
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function cast($key, $value)
    {
        if (array_key_exists($key, $this->arrays) && is_array($value)) {
            $class = $this->arrays[$key];
            return $this->setRawProperty($key, array_map(function ($item) use ($class) {
                return $class::makeFromArray($item);
            }, $value));
        } else {
            $class = is_int($key) ? $this->casts['all'] : $this->casts[$key];

            return $this->setRawProperty($key, $class::makeFromArray($value));
        }
    }

    /**
     * Set the raw property of a key
     *
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
     * Actually get the value for the key
     *
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
     * Magic method for calling get()
     *
     * @param string $name
     * @param array $arguments
     * @return array|mixed|null
     */
    public function __call($name, $arguments)
    {
        if (in_array($name, $this->dates)) {
            return $this->getDateTime($name, $arguments);
        }
        if ($data = $this->get($name)) {
            return $data;
        }
    }

    /**
     * Gets the supplied key's data as a datetime in UTC
     *
     * @param string|null $key
     * @param string $tz TimeZone string from the mentioned link
     * @return bool|DateTime
     *
     * @link https://secure.php.net/manual/en/timezones.php
     */
    public function getDateTime($key = null, $tz = null)
    {

        $string = $this->get($key);

        if (empty($string)) {
            return false;
        }

        if (is_array($tz)) {
            if (!empty($tz)) {
                $tz = $tz[0];
            } else {
                $tz = null;
            }
        } elseif (!is_string($tz)) {
            $tz = null;
        }

        $date = new DateTime($string);

        $timezone = new DateTimeZone($tz ?? $this->timezone);

        if ($date->getTimezone()->getName() != $timezone->getName()) {
            $date->setTimezone($timezone);
        }

        return $date;
    }

    /**
     * The Bungie API doesn't follow spec and reports the timezone as UTC despite it being Pacific. We have to manually fix this.
     *
     * @param null|string $date
     * @return DateTime|null
     *
     * @deprecated 0.2.5 The UTC/Pacific conversion may have been a misunderstanding, regardless it no longer appears to occur. Removing it soon as the lone function call is being removed.
     * @link https://github.com/Bungie-net/api/issues/353
     */
    private static function createDateTime(?string $date): ?DateTime
    {
        if (empty($date)) {
            return new DateTime(null);
        }

        $initialDate = new DateTime($date, new DateTimeZone('America/Los_Angeles'));

        $date = new DateTime($initialDate->format('Y-m-d\TH:i:s'), new DateTimeZone('America/Los_Angeles'));

        return $date;
    }
}