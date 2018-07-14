--TEST--
Support -d short option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '-d';
$_SERVER['argv'][3] = "user_agent=fake user agent";
$_SERVER['argv'][4] = '-d';
$_SERVER['argv'][5] = "error_log";
$_SERVER['argv'][6] = __DIR__ . '/options/IniSet.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: %d ms, Memory: %s

OK (2 tests, 2 assertions)
