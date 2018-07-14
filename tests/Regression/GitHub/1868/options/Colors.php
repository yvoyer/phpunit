<?php
class Colors extends \PHPUnit\Framework\TestCase
{
    public function testShouldAlwaysFail()
    {
        $this->fail('always failure');
    }

    public function testShouldAlwaysBeIncomplete()
    {
        $this->markTestIncomplete('always incomplete');
    }

    public function testShouldAlwaysPass()
    {
        $this->assertTrue(true);
    }

    public function testShouldAlwaysSkip()
    {
        $this->markTestSkipped('always skip');
    }

    public function testRisky()
    {
        // do not perform assertion
    }
}
