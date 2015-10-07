<?php
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Console\Input\InputOption;

/**
 * @since Class available since Release 6.0.0
 */
final class PHPUnit_TextUI_Option_TestdoxText extends PHPUnit_TextUI_Option_Option
{
    public function __construct()
    {
        parent::__construct(
            'testdox-text',
            null,
            InputOption::VALUE_REQUIRED,
            'Write agile documentation in Text format to file.'
        );
    }
}
