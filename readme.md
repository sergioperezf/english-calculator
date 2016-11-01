#English Calculator

##Introduction
The English Calculator adds up two integer numbers given in English.

The application is implemented using Zend Framework 3 on the back end. On the front end, Skeleton CSS and jQuery.

##Dependencies
Use `composer` to manage the dependencies of the application. There are only two dependencies:

- `zendframework/zendframework` version 3.0. This version requires PHP 5.6 or newer.
- `zendframework/zend-test` version 3.0 for the unit tests. This is a dev dependency.

###Installing the dependencies
The easiest way to install all the dependencies is by running:

	php composer.phar install
This will install the dependencies under the `vendor` directory.

##Running
To run the application, point the root of the vHost to `public`.  You can also run the application in dev mode by cd'ing to `/public` and running `php -S localhost:8080`.

##Version
This is version 1.0.1 of the Calculator.

##Testing
The whole of the application is unit tested using `PHPUnit`. To test the application, ensure that `PHPUnit` is installed (in dev environments it should get installed as a dependency of `zendframework/zend-test`) and run:

	phpunit --verbose
	
Or,	`./vendor/bin/phpunit.bat --verbose` if you installed all the dependencies locally and are running Windows.

A sample output looks similar to:

    PHPUnit 5.7-gb0c4a96 by Sebastian Bergmann and contributors.

    Runtime:       PHP 5.6.25

    ..........                                                       10 / 10 (100%)

    Time: 350 ms, Memory: 8.50MB

    OK (10 tests, 34 assertions)


##Author
- Name: Sergio Perez
- Email: seperezf@unal.edu.co
- WebSite: http://seperez.com