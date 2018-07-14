--TEST--
Support --stop-on-error long option.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--filter';
$_SERVER['argv'][] = 'Error';
$_SERVER['argv'][] = '--stop-on-error';
$_SERVER['argv'][] = __DIR__ . '/options/StopOn.php';

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

