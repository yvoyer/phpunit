<?php
final class FailOn extends PHPUnit\Framework\TestCase
{
    public function testRisky()
    {
        // Always risky, no assertion
    }

    public function testWarning()
    {
        trigger_error('warning', E_USER_WARNING);
    }
}
