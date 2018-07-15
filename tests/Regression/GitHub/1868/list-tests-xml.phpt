--TEST--
Support --list-tests-xml option.
--FILE--
<?php
require __DIR__ . '/../../../bootstrap.php';
$root = \org\bovigo\vfs\vfsStream::setup('root');

$_SERVER['argv'][] = ''; // present to start index at 0
$_SERVER['argv'][] = '--no-configuration';
$_SERVER['argv'][] = '--list-tests-xml';
$_SERVER['argv'][] = $root->url() . '/file.xml';
$_SERVER['argv'][] = '--test-suffix';
$_SERVER['argv'][] = 'Pass.php';
$_SERVER['argv'][] = __DIR__ . '/options';

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

Wrote list of tests that would have been run to vfs://root/file.xml
