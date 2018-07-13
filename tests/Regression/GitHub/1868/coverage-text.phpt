--TEST--
#1868: Support --coverage-text with specified file
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

\org\bovigo\vfs\vfsStream::enableDotfiles();
$root = \org\bovigo\vfs\vfsStream::setup('root', null, ['coverage.txt' => '']);

$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = __DIR__ . '/options/coverage.xml';
$_SERVER['argv'][3] = '--coverage-text';
$_SERVER['argv'][4] = $root->path() . '/coverage.txt';
$_SERVER['argv'][4] = dirname(__FILE__) . '/options/CoverageTest.php';

PHPUnit\TextUI\Command::main(false);

//$content = file_get_contents($root->getChild('coverage.txt')->url());
//$lines = explode(PHP_EOL, $content);
//array_walk($lines, 'trim');
//// forced to expect with var_dump, since there are whitespace in the content
//var_dump($lines);
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s ms, Memory: %sMB

OK (1 test, 1 assertion)


Code Coverage Report:   
  %s  
                        
 Summary:               
  Classes: 100.00% (1/1)
  Methods: 100.00% (1/1)
  Lines:   100.00% (2/2)

CoverageTest
  Methods: 100.00% ( 1/ 1)   Lines: 100.00% (  2/  2)
