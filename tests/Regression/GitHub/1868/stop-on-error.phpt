--TEST--
Support --stop-on-error long option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--filter';
$_SERVER['argv'][3] = 'Error';
$_SERVER['argv'][4] = '--stop-on-error';
$_SERVER['argv'][5] = __DIR__ . '/options/StopOn.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

E

Time: %s, Memory: %s

There was 1 error:

1) StopOn::testShouldBeError
Should error

%s/StopOn.php:31

ERRORS!
Tests: 1, Assertions: 0, Errors: 1.

