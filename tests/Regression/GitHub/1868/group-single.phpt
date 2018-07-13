--TEST--
#1868: Support --group with single group.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = dirname(__FILE__) . '/options/GroupTest.php';
$_SERVER['argv'][3] = '--group=group-1';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)
