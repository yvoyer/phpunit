--TEST--
Support --coverage-text with specified file
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
$_SERVER['argv'][] = __DIR__ . '/options/Coverage.php';

PHPUnit\TextUI\Command::main(false);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s ms, Memory: %sMB

OK (1 test, 1 assertion)


Code Coverage Report:%s
  %s
%s
 Summary:%s
  Classes: 100.00% (1/1)
  Methods: 100.00% (1/1)
  Lines:   100.00% (2/2)

Coverage
  Methods: 100.00% ( 1/ 1)   Lines: 100.00% (  2/  2)
