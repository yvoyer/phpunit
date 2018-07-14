--TEST--
Support --coverage-php option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';

$root = \org\bovigo\vfs\vfsStream::setup('root');

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '-c';
$_SERVER['argv'][] = __DIR__ . '/options/coverage.xml';
$_SERVER['argv'][] = '--coverage-php';
$_SERVER['argv'][] = $root->url() . '/coverage';
$_SERVER['argv'][] = __DIR__ . '/options/Coverage.php';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s, Memory: %s

OK (1 test, 1 assertion)

Generating code coverage report in PHP format ... done
