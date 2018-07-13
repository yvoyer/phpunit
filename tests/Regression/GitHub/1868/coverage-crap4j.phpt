--TEST--
#1868: Support --coverage-crap4j option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$root = \org\bovigo\vfs\vfsStream::setup('coverage');
$coveragePath = \org\bovigo\vfs\vfsStream::path('coverage');
$configPath = __DIR__ . '/options/coverage.xml';

$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = $configPath;
$_SERVER['argv'][3] = '--coverage-crap4j';
$_SERVER['argv'][4] = $coveragePath;
$_SERVER['argv'][5] = dirname(__FILE__) . '/options/CoverageTest.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)

Generating Crap4J report XML file ... done
