--TEST--
#1868: Support --printer option.
--FILE--
<?php
$_SERVER['argv'][1] = '--no-configuration';
$_SERVER['argv'][2] = dirname(__FILE__) . '/options/Coverage.php';
$_SERVER['argv'][3] = '--printer=TestPrinter';

require __DIR__ . '/../../../bootstrap.php';

use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\Framework\TestResult;

class TestPrinter extends ResultPrinter
{
    public function printResult(TestResult $result): void
    {
        $this->write('test');
        parent::printResult($result);
    }
}

PHPUnit\TextUI\Command::main();
?>
--EXPECTF--
PHPUnit %s by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)test

Time: %s ms, Memory: %s

OK (1 test, 1 assertion)
