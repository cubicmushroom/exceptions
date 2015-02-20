<?php
/**
 * Created by PhpStorm.
 * User: toby
 * Date: 31/01/15
 * Time: 15:38
 */

namespace CubicMushroom\Exceptions\Exception\Property;

use CubicMushroom\Exceptions\AbstractException;

class SetterNotFoundException extends AbstractException
{

    /**
     * @var string
     */
    protected $class;

    /**
     * Name of the property for which the setter is missing
     *
     * @var string
     */
    protected $property;


    /**
     * @param array $additionalProperties Additional properties passed to the build() method
     *
     * @return string
     */
    protected static function getDefaultMessage(array $additionalProperties)
    {
        return "Setter for property for {$additionalProperties['class']}::{$additionalProperties['property']} not " .
               "found";
    }


    /**
     * @return int
     */
    protected static function getDefaultCode()
    {
        return 500;
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Getters and Setters
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }


    /**
     * @param string $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }


    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }


    /**
     * @param string $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }
}