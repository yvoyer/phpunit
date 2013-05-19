<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit
 * @subpackage Runner
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.8.0
 */

/**
 * @package    PHPUnit
 * @subpackage Runner
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.8.0
 */
class PHPUnit_Runner_Configuration
{
    private $instance;

    private $cacheTokens = FALSE;
    private $addUncoveredFilesFromWhitelist = TRUE;
    private $processUncoveredFilesFromWhitelist = FALSE;
    private $reportCharset = 'UTF-8';
    private $reportHighlight = FALSE;
    private $reportHighLowerBound = 70;
    private $reportLowUpperBound = 35;

    private $backupGlobals = TRUE;
    private $backupStaticAttributes = FALSE;

    private $convertErrorsToExceptions = TRUE;
    private $convertNoticesToExceptions = TRUE;
    private $convertWarningsToExceptions = TRUE;

    private $groups = array();
    private $excludeGroups = array();

    private $stopOnError = FALSE;
    private $stopOnFailure = FALSE;
    private $stopOnIncomplete = FALSE;
    private $stopOnSkipped = FALSE;

    private $timeoutForSmallTests = 1;
    private $timeoutForMediumTests = 10;
    private $timeoutForLargeTests = 60;

    private $colors = FALSE;
    private $logIncompleteSkipped = FALSE;
    private $processIsolation = FALSE;
    private $repeat = FALSE;
    private $strict = FALSE;
    private $verbose = FALSE;

    public static function getInstance()
    {
        if ($this->instance === NULL) {
            $this->instance = new PHPUnit_Runner_Configuration;
        }

        return $this->instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public function getCacheTokens()
    {
        return $this->cacheTokens;
    }

    public function getAddUncoveredFilesFromWhitelist()
    {
        return $this->addUncoveredFilesFromWhitelist;
    }

    public function getProcessUncoveredFilesFromWhitelist()
    {
        return $this->processUncoveredFilesFromWhitelist;
    }

    public function getReportCharset()
    {
        return $this->reportCharset;
    }

    public function getReportHighlight()
    {
        return $this->reportHighlight;
    }

    public function getReportHighLowerBound()
    {
        return $this->reportHighLowerBound;
    }

    public function getReportLowUpperBound()
    {
        return $this->reportLowUpperBound;
    }

    public function getBackupGlobals()
    {
        return $this->backupGlobals;
    }

    public function getBackupStaticAttributes()
    {
        return $this->backupStaticAttributes;
    }

    public function getConvertErrorsToExceptions()
    {
        return $this->convertErrorsToExceptions;
    }

    public function getConvertNoticesToExceptions()
    {
        return $this->convertNoticesToExceptions;
    }

    public function getConvertWarningsToExceptions()
    {
        return $this->convertWarningsToExceptions;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function getExcludeGroups()
    {
        return $this->excludeGroups;
    }

    public function getStopOnError()
    {
        return $this->stopOnError;
    }

    public function getStopOnFailure()
    {
        return $this->stopOnFailure;
    }

    public function getStopOnIncomplete()
    {
        return $this->stopOnIncomplete;
    }

    public function getStopOnSkipped()
    {
        return $this->stopOnSkipped;
    }

    public function getTimeoutForSmallTests()
    {
        return $this->timeoutForSmallTests;
    }

    public function getTimeoutForMediumTests()
    {
        return $this->timeoutForMediumTests;
    }

    public function getTimeoutForLargeTests()
    {
        return $this->timeoutForLargeTests;
    }

    public function getColors()
    {
        return $this->colors;
    }

    public function getLogIncompleteSkipped()
    {
        return $this->logIncompleteSkipped;
    }

    public function getProcessIsolation()
    {
        return $this->processIsolation;
    }

    public function getRepeat()
    {
        return $this->repeat;
    }

    public function getStrict()
    {
        return $this->strict;
    }

    public function getVerbose()
    {
        return $this->verbose;
    }

    public function setCacheTokens($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->cacheTokens = $flag;
    }

    public function setAddUncoveredFilesFromWhitelist($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->addUncoveredFilesFromWhitelist = $flag;
    }

    public function setProcessUncoveredFilesFromWhitelist($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->processUncoveredFilesFromWhitelist = $flag;
    }

    public function setReportCharset($charset)
    {
        if (!is_string($charset)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->charset = $charset;
    }

    public function setReportHighlight($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->reportHighlight = $flag;
    }

    public function setReportHighLowerBound($bound)
    {
        if (!is_int($bound)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->reportHighLowerBound = $bound;
    }

    public function setReportLowUpperBound()
    {
        if (!is_int($bound)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->reportLowUpperBound = $bound;
    }

    public function setBackupGlobals($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->backupGlobals = $flag;
    }

    public function setBackupStaticAttributes($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->backupStaticAttributes = $flag;
    }

    public function setConvertErrorsToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->convertErrorsToExceptions = $flag;
    }

    public function setConvertNoticesToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->convertNoticesToExceptions = $flag;
    }

    public function setConvertWarningsToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->convertWarningsToExceptions = $flag;
    }

    public function setGroups(array $groups)
    {
        $this->groups = $groups;
    }

    public function setExcludeGroups(array $groups)
    {
        $this->excludeGroups = $groups;
    }

    public function setStopOnError($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnError = $flag;
    }

    public function setStopOnFailure($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnFailure = $flag;
    }

    public function setStopOnIncomplete($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnIncomplete = $flag;
    }

    public function setStopOnSkipped($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnSkipped = $flag;
    }

    public function setTimeoutForSmallTests($timeout)
    {
        if (!is_int($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->timeoutForSmallTests = $timeout;
    }

    public function setTimeoutForMediumTests($timeout)
    {
        if (!is_int($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->timeoutForMediumTests = $timeout;
    }

    public function setTimeoutForLargeTests($timeout)
    {
        if (!is_int($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->timeoutForLargeTests = $timeout;
    }

    public function setColors($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->colors = $flag;
    }

    public function setLogIncompleteSkipped($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->logIncompleteSkipped = $flag;
    }

    public function setProcessIsolation($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->processIsolation = $flag;
    }

    public function setRepeat($repeat)
    {
        if ($repeat !== FALSE && !is_int($repeat)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
              1, 'integer or false'
            );
        }

        $this->repeat = $repeat;
    }

    public function setStrict($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->strict = $flag;
    }

    public function setVerbose($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->verbose = $flag;
    }
}
