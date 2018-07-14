--TEST--
#1868: Support --colors option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--colors';
$_SERVER['argv'][3] = dirname(__FILE__) . '/options/Colors.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

FI.S                                                                4 / 4 (100%)

Time: %s, Memory: %s

There was 1 failure:

1) Colors::testShouldAlwaysFail
always failure

%s/Colors.php:6

FAILURES!
Tests: 4, Assertions: 2, Failures: 1, Skipped: 1, Incomplete: 1.
