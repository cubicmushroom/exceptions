<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 31/01/15
 * Time: 13:13
 */

namespace CubicMushroom\Exceptions\Exception\Defaults;

use CubicMushroom\Exceptions\AbstractException;

class MissingExceptionMessageException extends AbstractException
{
    const DEFAULT_MESSAGE = 'No message provided for Exception\'s build() method, and no default available';


    /**
     * Returns the message to use if not message is provided to build() method
     *
     * @param array $additionalProperties Additional properties passed to the build() method
     *
     * @return string
     */
    protected static function getDefaultMessage(array $additionalProperties)
    {
        return self::DEFAULT_MESSAGE;
    }
}