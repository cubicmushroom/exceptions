<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 31/01/15
 * Time: 11:36
 */

namespace CubicMushroom\Exceptions;

use CubicMushroom\Exceptions\Exception\Defaults\MissingExceptionMessageException;
use CubicMushroom\Exceptions\Exception\Property\SetterNotFoundException;

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
     * - previous (\Exception)
     *
     * If you don't pass in a 'message' or a 'code' then the method will attempt to get these from the exception class
     * getDefaultMessage or getDefaultCode methods, respectively.
     *
     * If no message is prepared, then we throw a \RuntimeException... There's no excuse for not including a useful
     * message!
     *
     * If no code if prepared, then 500 is used
     *
     * @param array $constructorArguments [optional] Arguments to be passed to the constructor
     * @param array $additionalProperties [optional] Additional p
     *
     * @return static
     *
     * @throws \RuntimeException if no message can be prepared... There's no excuse for not including a useful message!
     *
     */
    public static function build(array $constructorArguments = array(), $additionalProperties = array())
    {
        $constructorDefaults = array('message' => null, 'code' => null, 'previous' => null);
        $constructorArguments = array_merge($constructorDefaults, $constructorArguments);

        $message = self::prepareMessage($constructorArguments['message'], $additionalProperties);
        $code = self::prepareCode($constructorArguments['code']);
        $previous = $constructorArguments['previous'];

        $e = new static($message, $code, $previous);

        $e = self::addAdditionalProperties($e, $additionalProperties);

        return $e;
    }


    /**
     * Prepares the message from either its passed value, or the class' default message, accessed via it's
     * getDefaultMessage(), if it exists
     *
     * @param string $message              Message passed in to build()
     * @param array  $additionalProperties Additional properties passed to the build() method
     *
     * @return string
     * @throws MissingExceptionMessageException
     */
    protected static function prepareMessage($message, $additionalProperties)
    {
        if (empty($message)) {
            $message = static::getDefaultMessage($additionalProperties);
        }

        return $message;
    }


    /**
     * @param array $additionalProperties Additional properties passed to the build() method
     *
     * @return string Should return a string on child classes.  This class throws an exception, as there is no default
     *                message for the abstract class
     *
     * @throws MissingExceptionMessageException
     */
    protected static function getDefaultMessage(array $additionalProperties)
    {
        throw MissingExceptionMessageException::build();
    }


    /**
     * @param int $code Code passed in to build()
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


    /**
     * @param AbstractException $e    Newly created exception
     * @param array             $args Arguments passed to build to be added (see noted on build() method)
     *
     * @return static
     *
     * @throws SetterNotFoundException of
     */
    protected static function addAdditionalProperties(AbstractException $e, $args)
    {
        foreach ($args as $property => $value) {
            $setter = 'set' . ucfirst($property);
            if (!is_callable([$e, $setter])) {
                throw SetterNotFoundException::build(array(), array('property' => $property));
            }

            $e->$setter($value);
        }

        return $e;
    }
}