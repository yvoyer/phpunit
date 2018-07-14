--TEST--
Support --fail-on-risky.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--filter';
$_SERVER['argv'][3] = 'Risky';
$_SERVER['argv'][4] = '--fail-on-risky';
$_SERVER['argv'][5] = __DIR__ . '/options/FailOn.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

R                                                                   1 / 1 (100%)

Time: %s, Memory: %s

There was 1 risky test:

1) FailOn::testRisky
This test did not perform any assertions

%s/FailOn.php:4

OK, but incomplete, skipped, or risky tests!
Tests: 1, Assertions: 0, Risky: 1.
