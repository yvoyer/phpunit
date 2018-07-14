--TEST--
Support --test-suffix option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';
$root = \org\bovigo\vfs\vfsStream::setup('root');
$filepath = $root->url() . '/result.txt';

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--test-suffix';
$_SERVER['argv'][] = 'Check.php';
$_SERVER['argv'][] = __DIR__ . '/options';

PHPUnit\TextUI\Command::main(false);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

F                                                                   1 / 1 (100%)

Time: %s ms, Memory: %s

There was 1 failure:

1) SuffixCheck::testSuffixExecuted
--test--suffix works
Failed asserting that true is false.

%s/SuffixCheck.php:9

FAILURES!
Tests: 1, Assertions: 1, Failures: 1.
