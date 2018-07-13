<?php
final class StopOnTest extends PHPUnit\Framework\TestCase
{
    public function testShouldFail()
    {
        $this->fail('Always fail');
    }

    public function testShouldBeRisky()
    {
        // Always risky, no assertion
    }

    public function testShouldBeIncomplete()
    {
        $this->markTestIncomplete('Always incomplete');
    }

    public function testShouldBeSkipped()
    {
        $this->markTestSkipped('Always skip');
    }

    public function testShouldBeError()
    {
        trigger_error('Should error', E_USER_NOTICE);
    }

    public function testNeverExecutedInFailRiskyIncompleteSkippedError()
    {
        // should be the last test for --stop-on-* flags to exclude
        $this->fail('--stop-on-* should not execute this test');
    }
}
