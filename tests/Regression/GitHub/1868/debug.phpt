--TEST--
#1868: Support --debug option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--debug';
$_SERVER['argv'][3] = dirname(__FILE__) . '/options/CoverageTest.php';

require __DIR__ . '/../../../bootstrap.php';
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Test 'CoverageTest::test_it_should_always_return_true' started
Test 'CoverageTest::test_it_should_always_return_true' ended


Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
