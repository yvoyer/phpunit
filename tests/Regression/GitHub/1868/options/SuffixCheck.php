<?php

use PHPUnit\Framework\TestCase;

final class SuffixCheck extends TestCase
{
    public function testSuffixExecuted()
    {
        $this->assertFalse(true, '--test--suffix works');
    }
}
