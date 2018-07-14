--TEST--
Support --columns=max option.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = __DIR__ . '/options/Column.php';
$_SERVER['argv'][] = '--columns=max';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

....................                                              20 / 20 (100%)

Time: %s, Memory: %s

OK (20 tests, 20 assertions)
