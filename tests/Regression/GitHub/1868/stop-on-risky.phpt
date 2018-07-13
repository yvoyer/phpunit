--TEST--
#1868: Support --stop-on-risky long option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--filter';
$_SERVER['argv'][3] = 'Risky';
$_SERVER['argv'][4] = '--stop-on-risky';
$_SERVER['argv'][5] = __DIR__ . '/options/StopOnTest.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

R

Time: %s, Memory: %s

There was 1 risky test:

1) StopOnTest::testShouldBeRisky
This test did not perform any assertions

%s/tests/Regression/GitHub/1868/options/StopOnTest.php:9

OK, but incomplete, skipped, or risky tests!
Tests: 1, Assertions: 0, Risky: 1.

