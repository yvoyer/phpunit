--TEST--
#1868: Support --include-path option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--include-path';
$_SERVER['argv'][3] = __DIR__;
$_SERVER['argv'][4] = dirname(__FILE__) . '/options/IncludePathTest.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)
