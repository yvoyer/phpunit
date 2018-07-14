<?php

use PHPUnit\Framework\TestCase;

final class IniSet extends TestCase
{
    public function testSetSpecificValue()
    {
        $this->assertSame('fake user agent', \ini_get('user_agent'));
    }

    public function testSetDefaultValue()
    {
        $this->assertSame('1', \ini_get('error_log'));
    }
}
