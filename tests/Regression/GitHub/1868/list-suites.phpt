--TEST--
Support --list-suites option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--configuration';
$_SERVER['argv'][] = __DIR__ . '/options/testsuite.xml';
$_SERVER['argv'][] = '--list-suites';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Available test suite(s):
 - main
 - other
