Cubic Mushroom Exceptions
=========================

This library provides just a single abstract exception class with it's own bild() method for easily creating exceptions
with various properties, passed as an array of arguments.


How to use
----------

Just have a look at the `src/CubicMushroom/Exceptions/AbstractException` class methods for basic methods, but here is a 
brief overview...

`AbstractException` provides `build()` method that can be used to prepare exceptions to be thrown.

When using `build()`, you don't need to pass in a $message, $code.  If you don't the default for the class  will be 
used.  This is returned by the classes `getDefaultMessage()` and `getDefaultCode()` methods, if they exist.
   
As it's not helpful when an exception doesn't have a message, if no message is either passed, or a default set in the 
exception class, a `MissingExceptionMessageException` will be thrown.

The `build()` method also accepts a second array parameter.  If passed, the `build()` method will attempt to set all the 
properties on the build exception using the setter for the property.  If the setter is not found, then a 
`SetterNotFoundException` will be thrown.


Roadmap
-------

1. Stuff, as I think of it