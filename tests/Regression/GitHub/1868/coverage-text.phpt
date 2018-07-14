--TEST--
Support --coverage-text with specified file
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

\org\bovigo\vfs\vfsStream::enableDotfiles();
$root = \org\bovigo\vfs\vfsStream::setup('root');

$_SERVER['argv'][1] = '--configuration';
$_SERVER['argv'][2] = __DIR__ . '/options/coverage.xml';
$_SERVER['argv'][3] = '--coverage-text';
$_SERVER['argv'][4] = $root->path() . '/coverage.txt';
$_SERVER['argv'][5] = __DIR__ . '/options/Coverage.php';

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
