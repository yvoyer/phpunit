<?php

use PHPUnit\Framework\TestCase;

final class IniSet extends TestCase
{
    public function testSetValue()
    {
        $this->assertTrue(\defined(MY_KEY));
    }
}
