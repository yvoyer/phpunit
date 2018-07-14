--TEST--
Support --coverage-xml option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$root = \org\bovigo\vfs\vfsStream::setup('coverage');
$configPath = __DIR__ . '/options/coverage.xml';

$_SERVER['argv'][1] = '--configuration';
$_SERVER['argv'][2] = $configPath;
$_SERVER['argv'][3] = '--coverage-xml';
$_SERVER['argv'][4] = $root->url() . '/coverage.xml';
$_SERVER['argv'][5] = __DIR__ . '/options/Coverage.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)

Generating code coverage report in PHPUnit XML format ... done
