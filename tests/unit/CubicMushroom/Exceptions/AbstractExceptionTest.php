<?php
namespace CubicMushroom\Exceptions;

use CubicMushroom\Exceptions\Exception\Defaults\MissingExceptionMessageException;

class AbstractExceptionTest extends \PHPUnit_Framework_TestCase
{

    const ABSTRACT_EXCEPTION_DEFAULT_CODE = 500;


    protected function setUp()
    {
    }


    protected function tearDown()
    {
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Without Constructor Defaults Tests
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Tests that a class with no defaults when no arguments passed
     */
    public function testBuildWithNoDefaultsAndNoParameters()
    {
        try {
            ExtendedWithoutDefaultsException::build();
        } catch (MissingExceptionMessageException $thrownException) {
        }

        /** @noinspection PhpUndefinedVariableInspection */
        $this->assertNotEmpty($thrownException);
        $this->assertInstanceOf(get_class(new MissingExceptionMessageException), $thrownException);
        $this->assertEquals(MissingExceptionMessageException::DEFAULT_MESSAGE, $thrownException->getMessage());
    }


    /**
     * Tests that a class with no defaults when only a message is passed
     */
    public function testBuildWithNoDefaultsOnlyMessage()
    {
        $message = 'testBuildWithNoDefaultsOnlyMessage message';

        $builtException = ExtendedWithoutDefaultsException::build(array('message' => $message));

        $this->assertNotEmpty($builtException);
        $this->assertInstanceOf(get_class(new ExtendedWithoutDefaultsException), $builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals(self::ABSTRACT_EXCEPTION_DEFAULT_CODE, $builtException->getCode());
        $this->assertEmpty($builtException->getPrevious());
    }


    /**
     * Tests that a class with no defaults when only a code is passed
     */
    public function testBuildWithNoDefaultsOnlyCode()
    {
        $code = 1000;

        try {
            ExtendedWithoutDefaultsException::build(array('code' => $code));
        } catch (MissingExceptionMessageException $thrownException) {
        }

        /** @noinspection PhpUndefinedVariableInspection */
        $this->assertNotEmpty($thrownException);
        $this->assertInstanceOf(get_class(new MissingExceptionMessageException), $thrownException);
        $this->assertEquals(MissingExceptionMessageException::DEFAULT_MESSAGE, $thrownException->getMessage());
    }


    /**
     * Tests that a class with no defaults when only a previous exception is passed
     */
    public function testBuildWithNoDefaultsOnlyPrevious()
    {
        $previous = new PreviousException;

        try {
            ExtendedWithoutDefaultsException::build(array('previous' => $previous));
        } catch (MissingExceptionMessageException $thrownException) {
        }

        /** @noinspection PhpUndefinedVariableInspection */
        $this->assertNotEmpty($thrownException);
        $this->assertInstanceOf(get_class(new MissingExceptionMessageException), $thrownException);
        $this->assertEquals(MissingExceptionMessageException::DEFAULT_MESSAGE, $thrownException->getMessage());
    }


    /**
     * Tests that a class with no defaults when only a message and code are passed
     */
    public function testBuildWithNoDefaultsOnlyMessageAndCode()
    {
        $message = 'testBuildWithNoDefaultsOnlyMessage message';
        $code = 1000;

        $builtException = ExtendedWithoutDefaultsException::build(array('message' => $message, 'code' => $code));

        $this->assertNotEmpty($builtException);
        $this->assertInstanceOf(get_class(new ExtendedWithoutDefaultsException), $builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals($code, $builtException->getCode());
        $this->assertEmpty($builtException->getPrevious());
    }


    /**
     * Tests that a class with no defaults when only a message and previous exception are passed
     */
    public function testBuildWithNoDefaultsOnlyMessageAndPrevious()
    {
        $message = 'testBuildWithNoDefaultsOnlyMessage message';
        $previous = new PreviousException;

        $builtException = ExtendedWithoutDefaultsException::build(array(
            'message'  => $message,
            'previous' => $previous
        ));

        $this->assertNotEmpty($builtException);
        $this->assertInstanceOf(get_class(new ExtendedWithoutDefaultsException), $builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals($previous, $builtException->getPrevious());
        $this->assertEquals(self::ABSTRACT_EXCEPTION_DEFAULT_CODE, $builtException->getCode());
    }


    /**
     * Tests that a class with no defaults when only a code and previous exception are passed
     */
    public function testBuildWithNoDefaultsOnlyCodeAndPrevious()
    {
        $previous = new PreviousException;
        $code = 1000;

        try {
            ExtendedWithoutDefaultsException::build(array('code' => $code, 'previous' => $previous));
        } catch (MissingExceptionMessageException $thrownException) {
        }

        /** @noinspection PhpUndefinedVariableInspection */
        $this->assertNotEmpty($thrownException);
        $this->assertInstanceOf(get_class(new MissingExceptionMessageException), $thrownException);
        $this->assertEquals(MissingExceptionMessageException::DEFAULT_MESSAGE, $thrownException->getMessage());
        $this->assertEquals(self::ABSTRACT_EXCEPTION_DEFAULT_CODE, $thrownException->getCode());
        $this->assertEmpty($thrownException->getPrevious());
    }


    /**
     * Tests that a class with no defaults when only all exception constructor arguments are passed
     */
    public function testBuildWithNoDefaultsAllConstructorArguments()
    {
        $message = 'testBuildWithNoDefaultsOnlyMessage message';
        $code = 1000;
        $previous = new PreviousException;

        $builtException = ExtendedWithoutDefaultsException::build(array(
            'message'  => $message,
            'code'     => $code,
            'previous' => $previous,
        ));

        $this->assertNotEmpty($builtException);
        $this->assertInstanceOf(get_class(new ExtendedWithoutDefaultsException), $builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals($code, $builtException->getCode());
        $this->assertEquals($previous, $builtException->getPrevious());
    }


    // -----------------------------------------------------------------------------------------------------------------
    // With Constructor Defaults Tests
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Tests the build of an exception that has defaults with only a message
     */
    public function testBuildWithDefaultMessageOnlyMessage()
    {
        $message = 'testBuildWithDefaultMessageOnlyMessage message';

        $builtException = ExtendedWithDefaultsException::build(array('message' => $message));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals(ExtendedWithDefaultsException::DEFAULT_CODE, $builtException->getCode());
        $this->assertEmpty($builtException->getPrevious());
    }


    /**
     * Tests the build of an exception that has defaults with only a code
     */
    public function testBuildWithDefaultMessageOnlyCode()
    {
        $code = 1000;

        $builtException = ExtendedWithDefaultsException::build(array('code' => $code));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($code, $builtException->getCode());
        $this->assertEquals(ExtendedWithDefaultsException::DEFAULT_MESSAGE, $builtException->getMessage());
        $this->assertEmpty($builtException->getPrevious());
    }


    // Tests the build of an exception that has defaults with only a previous exception
    public function testBuildWithDefaultMessageOnlyPrevious()
    {
        $previous = new PreviousException;

        $builtException = ExtendedWithDefaultsException::build(array('previous' => $previous));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($previous, $builtException->getPrevious());
        $this->assertEquals(ExtendedWithDefaultsException::DEFAULT_MESSAGE, $builtException->getMessage());
        $this->assertEquals(ExtendedWithDefaultsException::DEFAULT_CODE, $builtException->getCode());
    }


    /**
     * Tests the build of an exception that has defaults with only a message and code
     */
    public function testBuildWithDefaultMessageOnlyMessageAndCode()
    {
        $message = 'testBuildWithDefaultMessageOnlyMessageAndCode message';
        $code = 1000;

        $builtException = ExtendedWithDefaultsException::build(array('message' => $message, 'code' => $code));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals($code, $builtException->getCode());
        $this->assertEmpty($builtException->getPrevious());
    }


    /**
     * Tests the build of an exception that has defaults with only a message and previous exception
     */
    public function testBuildWithDefaultMessageOnlyMessageAndPrevious()
    {
        $message = 'testBuildWithDefaultMessageOnlyMessageAndPrevious message';
        $previous = new PreviousException;

        $builtException = ExtendedWithDefaultsException::build(array('message' => $message, 'previous' => $previous));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals($previous, $builtException->getPrevious());
        $this->assertEquals(ExtendedWithDefaultsException::DEFAULT_CODE, $builtException->getCode());
    }


    /**
     * Tests the build of an exception that has defaults with only a code and previous exception
     */
    public function testBuildWithDefaultMessageOnlyCodeAndPrevious()
    {
        $code = 1000;
        $previous = new PreviousException;

        $builtException = ExtendedWithDefaultsException::build(array('code' => $code, 'previous' => $previous));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($code, $builtException->getCode());
        $this->assertEquals($previous, $builtException->getPrevious());
        $this->assertEquals(ExtendedWithDefaultsException::DEFAULT_MESSAGE, $builtException->getMessage());
    }


    // Tests the build of an exception that has defaults with all constructor arguments
    public function testBuildWithDefaultMessageAllConstructorArguments()
    {
        $message = 'testBuildWithDefaultMessageAllConstructorArguments message';
        $code = 1000;
        $previous = new PreviousException;

        $builtException = ExtendedWithDefaultsException::build(array(
            'message'  => $message,
            'code'     => $code,
            'previous' => $previous
        ));

        $this->assertNotEmpty($builtException);
        $this->assertEquals($message, $builtException->getMessage());
        $this->assertEquals($code, $builtException->getCode());
        $this->assertEquals($previous, $builtException->getPrevious());
    }


    // -----------------------------------------------------------------------------------------------------------------
    // Additional Arguments Tests
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Test valid additional arguments
     */
    public function testValidAdditionalArguments()
    {
        $additionalArgs = [
            'plain' => 'Single word property',
            'camelCase' => 'A camel cased property',
            'publicWithSetter' => 'A public property with a setter',
            // Not including public properties without setters at the moment.  May add these later.
            //'publicWithoutSetter' => 'A public property without a setter',
        ];

        $builtException = ExtendedAdditionalPropertiesException::build([], $additionalArgs);

        $this->assertNotEmpty($builtException);
        $this->assertEquals($additionalArgs['plain'], $builtException->getPlain());
        $this->assertEquals($additionalArgs['camelCase'], $builtException->getCamelCase());
        $this->assertEquals($additionalArgs['publicWithSetter'], $builtException->getPublicWithSetter());
        $this->assertEquals(1, $builtException->setterCalls['plain']);
        $this->assertEquals(1, $builtException->setterCalls['camelCase']);
        $this->assertEquals(1, $builtException->setterCalls['publicWithSetter']);
    }
    // Test invalid additional arguments
}


// ---
// Test classes
// ---

/**
 * Class PreviousException
 *
 * Unique classed to be used as the previous exception to avoid possible false positives when checking classes
 *
 * @package CubicMushroom\Exceptions
 */
class PreviousException extends \Exception
{
}


/**
 * Class ExtendedWithoutDefaultsException
 *
 * Exception class that does not include a default message or code getter
 *
 * @package CubicMushroom\Exceptions
 */
class ExtendedWithoutDefaultsException extends AbstractException
{
}


/**
 * Class ExtendedWithoutDefaultsException
 *
 * Exception class that includes default message and code getter
 *
 * @package CubicMushroom\Exceptions
 */
class ExtendedWithDefaultsException extends AbstractException
{

    const DEFAULT_MESSAGE = 'ExtendedWithDefaultsException message';

    const DEFAULT_CODE = 1100;


    /**
     * @param array $additionalProperties Additional properties passed to the build() method
     *
     * @return string
     */
    protected static function getDefaultMessage(array $additionalProperties)
    {
        return self::DEFAULT_MESSAGE;
    }


    protected static function getDefaultCode()
    {
        return self::DEFAULT_CODE;
    }
}


/**
 * Class ExtendedWithoutDefaultsException
 *
 * Exception class that includes default message and code getter
 *
 * @package CubicMushroom\Exceptions
 */
class ExtendedAdditionalPropertiesException extends AbstractException
{

    public $publicWithSetter;

    public $publicWithoutSetter;

    protected $plain;

    protected $camelCase;

    public $setterCalls = [
        'plain'            => 0,
        'camelCase'        => 0,
        'publicWithSetter' => 0
    ];


    /**
     * @return mixed
     */
    public function getPlain()
    {
        return $this->plain;
    }


    /**
     * @param mixed $plain
     */
    public function setPlain($plain)
    {
        $this->setterCalls['plain']++;
        $this->plain = $plain;
    }


    /**
     * @return mixed
     */
    public function getCamelCase()
    {
        return $this->camelCase;
    }


    /**
     * @param mixed $camelCase
     */
    public function setCamelCase($camelCase)
    {
        $this->setterCalls['camelCase']++;
        $this->camelCase = $camelCase;
    }


    /**
     * @param array $additionalProperties Additional properties passed to the build() method
     *
     * @return string
     */
    protected static function getDefaultMessage(array $additionalProperties)
    {
        return 'ExtendedAdditionalPropertiesException message';
    }


    protected static function getDefaultCode()
    {
        return 1200;
    }


    /**
     * @return mixed
     */
    public function getPublicWithSetter()
    {
        return $this->publicWithSetter;
    }


    /**
     * @param mixed $publicWithSetter
     */
    public function setPublicWithSetter($publicWithSetter)
    {
        $this->setterCalls['publicWithSetter']++;
        $this->publicWithSetter = $publicWithSetter;
    }
}