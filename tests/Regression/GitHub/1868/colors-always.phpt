--TEST--
#1868: Support --colors=always option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = dirname(__FILE__) . '/options/ColorsTest.php';
$_SERVER['argv'][3] = '--colors=always';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

FI.S                                                                   1 / 1 (100%)

Time: %s, Memory: %s

There was 1 failure:

1) ColorsTest::testShouldAlwaysFail
always failure

%s/ColorsTest.php:6

%sFAILURES!%s
Tests: 4, Assertions: 1, Failures: 1, Skipped: 1, Incomplete: 1.
