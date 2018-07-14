--TEST--
#1868: Support --stop-on-defect.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--stop-on-defect';
$_SERVER['argv'][3] = __DIR__ . '/options/StopOn.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

F

Time: %s, Memory: %s

There was 1 failure:

1) StopOn::testShouldFail
Always fail

%s/tests/Regression/GitHub/1868/options/StopOn.php:6

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.

