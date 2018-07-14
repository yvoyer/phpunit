--TEST--
Support --testsuite option.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '-c';
$_SERVER['argv'][] = __DIR__ . '/options/testsuite.xml';
$_SERVER['argv'][] = '--testsuite';
$_SERVER['argv'][] = 'main';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
