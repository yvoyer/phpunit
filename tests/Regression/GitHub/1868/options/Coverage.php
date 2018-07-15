<?php

/**
 * @covers CoverStub
 */
class Coverage extends PHPUnit\Framework\TestCase
{
    public function test_it_should_always_return_true()
    {
        $this->assertTrue(CoverStub::notCoveredWithUse());
    }
}

final class CoverStub {
    public static function notCoveredWithUse()
    {
        return true;
    }
}
