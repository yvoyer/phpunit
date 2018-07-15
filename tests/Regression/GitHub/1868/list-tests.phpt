--TEST--
Support --list-tests option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--list-tests';
$_SERVER['argv'][] = '--test-suffix';
$_SERVER['argv'][] = 'Pass.php';
$_SERVER['argv'][] = __DIR__ . '/options';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Available test(s):
 - AlwaysPass::testTrue
