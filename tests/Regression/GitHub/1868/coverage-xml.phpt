--TEST--
#1868: Support --coverage-xml option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$root = \org\bovigo\vfs\vfsStream::setup('coverage', 0777);
$coveragePath = \org\bovigo\vfs\vfsStream::url('coverage');
$configPath = __DIR__ . '/options/coverage.xml';

$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = $configPath;
$_SERVER['argv'][3] = '--coverage-xml';
$_SERVER['argv'][4] = $coveragePath;
$_SERVER['argv'][2] = __DIR__ . '/options/Coverage.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)

Generating code coverage report in PHPUnit XML format ... done
