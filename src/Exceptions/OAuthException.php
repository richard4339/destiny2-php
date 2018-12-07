<?php
/**
 * destiny2-php
 * @author Richard Lynskey <richard@mozor.net>
 * @copyright Copyright (c) 2017, Richard Lynskey
 * @license https://opensource.org/licenses/MIT MIT
 *
 */

namespace Destiny\Exceptions;

use Throwable;

/**
 * Class OAuthException
 * @package Destiny\Exceptions
 */
class OAuthException extends Exception
{

    /**
     * OAuthException constructor.
     * @param string $message
     * @param int $code
     * @param int $seconds
     * @param string $status
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "No OAuth access token provided to method that requires authentication.", int $code = 0, int $seconds = 0, string $status = '', ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $seconds, $status, $previous);
    }
}