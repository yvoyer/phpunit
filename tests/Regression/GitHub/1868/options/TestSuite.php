<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class TestSuite extends TestCase
{
    public function testPass()
    {
        $this->assertTrue(true);
    }
}
