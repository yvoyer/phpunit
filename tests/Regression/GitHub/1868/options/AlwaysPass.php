<?php

use PHPUnit\Framework\TestCase;

final class AlwaysPass extends TestCase
{
    public function testTrue()
    {
        $this->assertTrue(true);
    }
}
