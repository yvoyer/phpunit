--TEST--
Support --stop-on-warning.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--filter';
$_SERVER['argv'][] = 'Warning';
$_SERVER['argv'][] = '--stop-on-warning';
$_SERVER['argv'][] = __DIR__ . '/options/StopOn.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

E                                                                   1 / 1 (100%)

Time: %s, Memory: %s

There was 1 error:

1) StopOn::testShouldBeWarning
Should error

%s/StopOn.php:26

ERRORS!
Tests: 1, Assertions: 0, Errors: 1.

