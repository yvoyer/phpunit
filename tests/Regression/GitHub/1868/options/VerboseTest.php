<?php
/**
 * This file is part of the phpunit project.
 *
 * (c) Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */

/**
 * Class VerboseTest
 *
 * @author Yannick Voyer <star.yvoyer@gmail.com> (http://github.com/yvoyer)
 */
final class VerboseTest extends PHPUnit_Framework_TestCase
{
    public function testVerbose()
    {
        $this->markTestIncomplete('incompleted test for verbose assertion');
    }
}
