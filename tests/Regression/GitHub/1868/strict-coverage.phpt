--TEST--
Support --strict-coverage-text with specified file
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

\org\bovigo\vfs\vfsStream::enableDotfiles();
$root = \org\bovigo\vfs\vfsStream::setup('root');

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--configuration';
$_SERVER['argv'][] = __DIR__ . '/options/coverage.xml';
$_SERVER['argv'][] = '--coverage-text';
$_SERVER['argv'][] = $root->path() . '/coverage.txt';
$_SERVER['argv'][] = '--strict-coverage';
$_SERVER['argv'][] = __DIR__ . '/options/Coverage.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

R                                                                   1 / 1 (100%)

Time: %s ms, Memory: %sMB

There was 1 risky test:

1) Coverage::test_it_should_always_return_true
This test executed code that is not listed as code to be covered or used:


Code Coverage Report:  %s
%s
%s
%s
  Classes: 0.00% (0/2)%s
  Methods: 0.00% (0/2)
  Lines:   0.00% (0/3)

