--TEST--
Support --verbose long option.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--verbose';
$_SERVER['argv'][] = __DIR__ . '/options/Verbose.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Runtime:       %s with Xdebug %s

I                                                                   1 / 1 (100%)

Time: %s, Memory: %s

There was 1 incomplete test:

1) Verbose::testVerbose
incompleted test for verbose assertion

%s/Verbose.php:6

OK, but incomplete, skipped, or risky tests!
Tests: 1, Assertions: 0, Incomplete: 1.

