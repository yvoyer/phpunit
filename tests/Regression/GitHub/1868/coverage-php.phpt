--TEST--
Support --coverage-php option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$root = \org\bovigo\vfs\vfsStream::setup('root');

$_SERVER['argv'][1] = '-c';
$_SERVER['argv'][2] = __DIR__ . '/options/coverage.xml';
$_SERVER['argv'][3] = '--coverage-php';
$_SERVER['argv'][4] = $root->url() . '/coverage';
$_SERVER['argv'][5] = __DIR__ . '/options/Coverage.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)

Generating code coverage report in PHP format ... done
