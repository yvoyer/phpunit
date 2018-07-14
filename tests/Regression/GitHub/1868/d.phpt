--TEST--
#1868: Support -d short option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--d';
$_SERVER['argv'][3] = 'MY_KEY=true';
$_SERVER['argv'][4] = __DIR__ . '/options/IniSet.php';

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
