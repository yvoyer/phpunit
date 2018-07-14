--TEST--
Support --stop-on-defect.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--stop-on-defect';
$_SERVER['argv'][] = __DIR__ . '/options/StopOn.php';

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

%s/StopOn.php:6

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.

