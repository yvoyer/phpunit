<?php

use PHPUnit\Framework\TestCase;

class ConfigurationTest extends TestCase
{
    public function testConstantDefinedInConfigFile()
    {
        // defined in config file for test
        $this->assertTrue(\defined(PHPUNIT_CONFIGURATION_OPTION_TEST));
    }
}
