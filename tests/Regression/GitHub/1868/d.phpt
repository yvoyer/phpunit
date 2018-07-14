--TEST--
Support -d short option.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '-d';
$_SERVER['argv'][] = "user_agent=fake user agent";
$_SERVER['argv'][] = '-d';
$_SERVER['argv'][] = "error_log";
$_SERVER['argv'][] = __DIR__ . '/options/IniSet.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: %d ms, Memory: %s

OK (2 tests, 2 assertions)
