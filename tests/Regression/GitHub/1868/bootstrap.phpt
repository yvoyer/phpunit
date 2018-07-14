--TEST--
Support bootstrap option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--bootstrap=' . __DIR__ . '/../../../bootstrap.php';
$_SERVER['argv'][3] = __DIR__ . '/options/Bootstrap.php';

require __DIR__ . '/../../../../vendor/autoload.php';
\PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)
