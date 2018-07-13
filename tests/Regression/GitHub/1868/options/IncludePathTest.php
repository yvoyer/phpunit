<?php
class IncludePathTest extends \PHPUnit\Framework\TestCase
{
    public function testShouldSetIncludePath()
    {
        $this->assertContains('tests/Regression/GitHub/1868', ini_get('include_path'));
    }
}
