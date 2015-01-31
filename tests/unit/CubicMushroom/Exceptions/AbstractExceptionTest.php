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



}


// ---
// Test classes
// ---

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