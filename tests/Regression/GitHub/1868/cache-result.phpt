--TEST--
Support --cache-result and --cache-result-file option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';
$root = \org\bovigo\vfs\vfsStream::setup('root');
$filepath = $root->url() . '/result.txt';

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--cache-result';
$_SERVER['argv'][] = '--cache-result-file';
$_SERVER['argv'][] = $filepath;
$_SERVER['argv'][] = __DIR__ . '/options/AlwaysPass.php';

PHPUnit\TextUI\Command::main(false);
var_dump(file_get_contents($filepath));
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
string(110) "C:30:"PHPUnit\Runner\TestResultCache":67:{a:2:{s:7:"defects";a:0:{}s:5:"times";a:1:{s:8:"testTrue"%s
