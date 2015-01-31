<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 31/01/15
 * Time: 11:36
 */

namespace CubicMushroom\Exceptions;

use CubicMushroom\Exceptions\Exception\Defaults\MissingExceptionMessageException;

/**
 * Class AbstractException
 *
 * Basic abstract class that provieds a handy static build() class that allows you to
 *
 * @package CubicMushroom\Exceptions
 */
class AbstractException extends \Exception
{

    /**
     * Helper method to prepare all but the most complex exceptions
     *
     * Pass in an array containing any or all of the following keys
     * - message (string)
     * - code (int)
     * - precious (\Exception)
     *
     * If you don't pass in a 'message' or a 'code' then the method will attempt to get these from the exception class
     * getDefaultMessage or getDefaultCode methods, respectively.
     *
     * If no message is prepared, then we throw a \RuntimeException... There's no excuse for not including a useful
     * message!
     *
     * If no code if prepared, then 500 is used
     *
     * @param $constructorArguments
     *
     * @return static
     *
     * @throws \RuntimeException if no message can be prepared... There's no excuse for not including a useful message!
     *
     */
    public static function build(array $constructorArguments = array())
    {
        $constructorDefaults = ['message' => null, 'code' => null, 'previous' => null];
        $constructorArguments = array_merge($constructorDefaults, $constructorArguments);

        $message = self::prepareMessage($constructorArguments['message']);
        $code = self::prepareCode($constructorArguments['code']);
        $previous = $constructorArguments['previous'];

        return new static($message, $code, $previous);
    }


    /**
     * Prepares the message from either its passed value, or the class' default message, accessed via it's
     * getDefaultMessage(), if it exists
     *
     * @param string $message Message passed in to build()
     *
     * @return string
     *
     * @throws \RuntimeException if no message can be prepared
     */
    protected static function prepareMessage($message)
    {
        if (empty($message)) {
            $message = static::getDefaultMessage();
        }

        return $message;
    }


    /**
     * @return string Should return a string on child classes.  This class throws an exception, as there is no default
     *                message for the abstract class
     *
     * @throws MissingExceptionMessageException
     */
    protected static function getDefaultMessage()
    {
        throw MissingExceptionMessageException::build();
    }


    /**
     * @param int    $code  Code passed in to build()
     *
     * @return int
     */
    protected static function prepareCode($code)
    {
        if (empty($code)) {
            $code = static::getDefaultCode();
        }

        return $code;
    }


    /**
     * @return int
     */
    protected static function getDefaultCode()
    {
        return 500;
    }
}