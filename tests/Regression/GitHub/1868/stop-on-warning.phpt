--TEST--
#1868: Support --stop-on-warning.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--filter';
$_SERVER['argv'][3] = 'Warning';
$_SERVER['argv'][4] = '--stop-on-warning';
$_SERVER['argv'][5] = __DIR__ . '/options/StopOn.php';

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

%s/tests/Regression/GitHub/1868/options/StopOn.php:26

ERRORS!
Tests: 1, Assertions: 0, Errors: 1.

