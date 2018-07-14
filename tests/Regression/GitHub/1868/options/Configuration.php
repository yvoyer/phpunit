<?php

use PHPUnit\Framework\TestCase;

class Configuration extends TestCase
{
    public function testConstantDefinedInConfigFile()
    {
        // defined in config file for test
        $this->assertTrue(\defined('STUB_CONSTANT'));
    }
}
