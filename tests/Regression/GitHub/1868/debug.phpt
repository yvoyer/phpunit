--TEST--
Support --debug option.
--FILE--
<?php
$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--debug';
$_SERVER['argv'][] = __DIR__ . '/options/Coverage.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Test 'Coverage::test_it_should_always_return_true' started
Test 'Coverage::test_it_should_always_return_true' ended


Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
