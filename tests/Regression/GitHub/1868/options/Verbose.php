<?php
final class Verbose extends PHPUnit\Framework\TestCase
{
    public function testVerbose()
    {
        $this->markTestIncomplete('incompleted test for verbose assertion');
    }
}
