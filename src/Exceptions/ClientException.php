<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 * @version 0.1
 *
 * Built 2017-09-23 10:17 CDT by richard
 *
 */

namespace Destiny\Exceptions;

use Throwable;

/**
 * Class ClientException
 * @package Destiny\Exceptions
 *
 * @property int $throttleSeconds
 * @property string $status
 */
class ClientException extends Exception
{
    /**
     * ClientException constructor.
     * @param string $message
     * @param int $code
     * @param int $seconds
     * @param string $status
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, $seconds = 0, $status = '', Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->throttleSeconds = $seconds;
        $this->status = $status;
    }

}