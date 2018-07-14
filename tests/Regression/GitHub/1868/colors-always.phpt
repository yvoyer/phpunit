--TEST--
Support --colors=always option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--colors';
$_SERVER['argv'][3] = 'always';
$_SERVER['argv'][4] = __DIR__ . '/options/Colors.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

FI.SR                                                               5 / 5 (100%)

Time: %s ms, Memory: %s

There was 1 failure:

1) Colors::testShouldAlwaysFail
always failure

%s/Colors.php:6

--

There was 1 risky test:

1) Colors::testRisky
This test did not perform any assertions

%s/Colors.php:24

FAILURES!
Tests: 5, Assertions: 2, Failures: 1, Skipped: 1, Incomplete: 1, Risky: 1.
