--TEST--
#1868: Support --check-version option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = '--check-version';

require __DIR__ . '/../../../bootstrap.php';
define('__PHPUNIT_PHAR__', '');
PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

You are using the latest version of PHPUnit.
