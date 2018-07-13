--TEST--
#1868: Support --stderr long option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--stderr';
$_SERVER['argv'][3] = dirname(__FILE__) . '/options/CoverageTest.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--

PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
