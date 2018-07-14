<?php
class Column extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider provideColumnCount
     */
    public function testShouldAlwaysPass()
    {
        $this->assertTrue(true);
    }

    public function provideColumnCount()
    {
        $data = [];
        for ($i = 0; $i < 20; $i++) {
            $data[] = [];
        }

        return $data;
    }
}
