<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2001-2014, Sebastian Bergmann <sebastian@phpunit.de>.
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
 * @copyright  2001-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 4.2.0
 */

/**
 * @package    PHPUnit
 * @subpackage Runner
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2014 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 4.2.0
 */
class PHPUnit_Runner_Configuration
{
    /**
     * @var PHPUnit_Runner_Configuration
     */
    private static $instance;

    /**
     * @var array
     */
    private $logTargets = array();

    /**
     * @var boolean
     */
    private $cacheTokens = false;

    /**
     * @var boolean
     */
    private $addUncoveredFilesFromWhitelist = true;

    /**
     * @var boolean
     */
    private $forceCoversAnnotation = false;

    /**
     * @var boolean
     */
    private $mapTestClassNameToCoveredClassName = false;

    /**
     * @var boolean
     */
    private $processUncoveredFilesFromWhitelist = false;

    /**
     * @var integer
     */
    private $reportLowUpperBound = 50;

    /**
     * @var integer
     */
    private $reportHighLowerBound = 90;

    /**
     * @var boolean
     */
    private $showUncoveredFiles = false;

    /**
     * @var boolean
     */
    private $showOnlySummary = false;

    /**
     * @var array
     */
    private $blacklist = array(
        'include' => array(
            'directory' => array(),
            'file' => array()
        ),
        'exclude' => array(
            'directory' => array(),
            'file' => array()
        )
    );

    /**
     * @var array
     */
    private $whitelist = array(
        'include' => array(
            'directory' => array(),
            'file' => array()
        ),
        'exclude' => array(
            'directory' => array(),
            'file' => array()
        )
    );

    /**
     * @var boolean
     */
    private $backupGlobals = true;

    /**
     * @var boolean
     */
    private $backupStaticAttributes = false;

    /**
     * @var boolean
     */
    private $convertErrorsToExceptions = true;

    /**
     * @var boolean
     */
    private $convertNoticesToExceptions = true;

    /**
     * @var boolean
     */
    private $convertWarningsToExceptions = true;

    /**
     * @var array
     */
    private $groups = array();

    /**
     * @var array
     */
    private $excludeGroups = array();

    /**
     * @var string
     */
    private $filter;

    /**
     * @var boolean
     */
    private $stopOnError = false;

    /**
     * @var boolean
     */
    private $stopOnFailure = false;

    /**
     * @var boolean
     */
    private $stopOnIncomplete = false;

    /**
     * @var boolean
     */
    private $stopOnSkipped = false;

    /**
     * @var integer
     */
    private $timeoutForSmallTests = 1;

    /**
     * @var integer
     */
    private $timeoutForMediumTests = 10;

    /**
     * @var integer
     */
    private $timeoutForLargeTests = 60;

    /**
     * @var string
     */
    private $printerClass = 'PHPUnit_TextUI_ResultPrinter';

    /**
     * @var string
     */
    private $testSuiteLoaderClass = 'PHPUnit_Runner_StandardTestSuiteLoader';

    /**
     * @var array
     */
    private $includePaths = array();

    /**
     * @var array
     */
    private $iniSettings = array();

    /**
     * @var array
     */
    private $constants = array();

    /**
     * @var array
     */
    private $globalVariables = array();

    /**
     * @var array
     */
    private $envVariables = array();

    /**
     * @var array
     */
    private $postVariables = array();

    /**
     * @var array
     */
    private $getVariables = array();

    /**
     * @var array
     */
    private $cookieVariables = array();

    /**
     * @var array
     */
    private $serverVariables = array();

    /**
     * @var array
     */
    private $filesVariables = array();

    /**
     * @var array
     */
    private $requestVariables = array();

    /**
     * @var string|false
     */
    private $bootstrap = false;

    /**
     * @var boolean
     */
    private $colors = false;

    /**
     * @var boolean
     */
    private $debug = false;

    /**
     * @var boolean
     */
    private $logIncompleteSkipped = false;

    /**
     * @var boolean
     */
    private $processIsolation = false;

    /**
     * @var integer|false
     */
    private $repeat = false;

    /**
     * @var boolean
     */
    private $beStrictAboutTestsThatDoNotTestAnything = false;

    /**
     * @var boolean
     */
    private $beStrictAboutOutputDuringTests = false;

    /**
     * @var boolean
     */
    private $beStrictAboutTestSize = false;

    /**
     * @var boolean
     */
    private $beStrictAboutTodoAnnotatedTests = false;

    /**
     * @var boolean
     */
    private $checkForUnintentionallyCoveredCode = false;

    /**
     * @var boolean
     */
    private $verbose = false;

    /**
     * @var array
     */
    private $browsers = array();

    /**
     * @var PHPUnit_Framework_TestSuite
     */
    private $testSuite;

    /**
     * @var array
     */
    private $listeners = array();

    /**
     * @var array
     */
    private $sources = array();

    /**
     * @return PHPUnit_Runner_Configuration
     */
    public static function getInstance()
    {
        if (self::$instance === NULL) {
            self::$instance = new PHPUnit_Runner_Configuration;
        }

        return self::$instance;
    }

    /**
     */
    private function __construct()
    {
    }

    /**
     */
    private function __clone()
    {
    }

    /**
     */
    private function __wakeup()
    {
    }

    /**
     * @return array
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @return array
     */
    public function getLogTargets()
    {
        return $this->logTargets;
    }

    /**
     * @return array
     */
    public function getBrowsers()
    {
        return $this->browsers;
    }

    /**
     * @return boolean
     */
    public function getCacheTokens()
    {
        return $this->cacheTokens;
    }

    /**
     * @return boolean
     */
    public function getAddUncoveredFilesFromWhitelist()
    {
        return $this->addUncoveredFilesFromWhitelist;
    }

    /**
     * @return boolean
     */
    public function getForceCoversAnnotation()
    {
        return $this->forceCoversAnnotation;
    }

    /**
     * @return boolean
     */
    public function getMapTestClassNameToCoveredClassName()
    {
        return $this->mapTestClassNameToCoveredClassName;
    }

    /**
     * @return boolean
     */
    public function getProcessUncoveredFilesFromWhitelist()
    {
        return $this->processUncoveredFilesFromWhitelist;
    }

    /**
     * @return integer
     */
    public function getReportHighLowerBound()
    {
        return $this->reportHighLowerBound;
    }

    /**
     * @return integer
     */
    public function getReportLowUpperBound()
    {
        return $this->reportLowUpperBound;
    }

    /**
     * @return boolean
     */
    public function getShowUncoveredFiles()
    {
        return $this->showUncoveredFiles;
    }

    /**
     * @return boolean
     */
    public function getShowOnlySummary()
    {
        return $this->showOnlySummary;
    }

    /**
     * @return array
     */
    public function getBlacklist()
    {
        return $this->blacklist;
    }

    /**
     * @return array
     */
    public function getWhitelist()
    {
        return $this->whitelist;
    }

    /**
     * @return boolean
     */
    public function getBackupGlobals()
    {
        return $this->backupGlobals;
    }

    /**
     * @return boolean
     */
    public function getBackupStaticAttributes()
    {
        return $this->backupStaticAttributes;
    }

    /**
     * @return boolean
     */
    public function getConvertErrorsToExceptions()
    {
        return $this->convertErrorsToExceptions;
    }

    /**
     * @return boolean
     */
    public function getConvertNoticesToExceptions()
    {
        return $this->convertNoticesToExceptions;
    }

    /**
     * @return boolean
     */
    public function getConvertWarningsToExceptions()
    {
        return $this->convertWarningsToExceptions;
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @return array
     */
    public function getExcludeGroups()
    {
        return $this->excludeGroups;
    }

    /**
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return boolean
     */
    public function getStopOnError()
    {
        return $this->stopOnError;
    }

    /**
     * @return boolean
     */
    public function getStopOnFailure()
    {
        return $this->stopOnFailure;
    }

    /**
     * @return boolean
     */
    public function getStopOnIncomplete()
    {
        return $this->stopOnIncomplete;
    }

    /**
     * @return boolean
     */
    public function getStopOnSkipped()
    {
        return $this->stopOnSkipped;
    }

    /**
     * @return integer
     */
    public function getTimeoutForSmallTests()
    {
        return $this->timeoutForSmallTests;
    }

    /**
     * @return integer
     */
    public function getTimeoutForMediumTests()
    {
        return $this->timeoutForMediumTests;
    }

    /**
     * @return integer
     */
    public function getTimeoutForLargeTests()
    {
        return $this->timeoutForLargeTests;
    }

    /**
     * @return array
     */
    public function getIncludePaths()
    {
        return $this->includePaths;
    }

    /**
     * @return array
     */
    public function getIniSettings()
    {
        return $this->iniSettings;
    }

    /**
     * @return array
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * @return array
     */
    public function getGlobalVariables()
    {
        return $this->globalVariables;
    }

    /**
     * @return array
     */
    public function getEnvVariables()
    {
        return $this->envVariables;
    }

    /**
     * @return array
     */
    public function getPostVariables()
    {
        return $this->postVariables;
    }

    /**
     * @return array
     */
    public function getGetVariables()
    {
        return $this->getVariables;
    }

    /**
     * @return array
     */
    public function getCookieVariables()
    {
        return $this->cookieVariables;
    }

    /**
     * @return array
     */
    public function getServerVariables()
    {
        return $this->serverVariables;
    }

    /**
     * @return array
     */
    public function getFilesVariables()
    {
        return $this->filesVariables;
    }

    /**
     * @return array
     */
    public function getRequestVariables()
    {
        return $this->requestVariables;
    }

    /**
     * @return string|false
     */
    public function getBootstrap()
    {
        return $this->bootstrap;
    }

    /**
     * @return string
     */
    public function getPrinterClass()
    {
        return $this->printerClass;
    }

    /**
     * @return string
     */
    public function getTestSuiteLoaderClass()
    {
        return $this->testSuiteLoaderClass;
    }

    /**
     * @return boolean
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @return boolean
     */
    public function getDebug()
    {
        return $this->debug;
    }

    /**
     * @return boolean
     */
    public function getLogIncompleteSkipped()
    {
        return $this->logIncompleteSkipped;
    }

    /**
     * @return boolean
     */
    public function getProcessIsolation()
    {
        return $this->processIsolation;
    }

    /**
     * @return boolean
     */
    public function getRepeat()
    {
        return $this->repeat;
    }

    /**
     * @return boolean
     */
    public function isStrictAboutTestsThatDoNotTestAnything()
    {
        return $this->beStrictAboutTestsThatDoNotTestAnything;
    }

    /**
     * @return boolean
     */
    public function isStrictAboutOutputDuringTests()
    {
        return $this->beStrictAboutOutputDuringTests;
    }

    /**
     * @return boolean
     */
    public function isStrictAboutTestSize()
    {
        return $this->beStrictAboutTestSize;
    }

    /**
     * @return boolean
     */
    public function isStrictAboutTodoAnnotatedTests()
    {
        return $this->beStrictAboutTodoAnnotatedTests;
    }

    /**
     * @return boolean
     */
    public function checkForUnintentionallyCoveredCode()
    {
        return $this->checkForUnintentionallyCoveredCode;
    }

    /**
     * @return boolean
     */
    public function getVerbose()
    {
        return $this->verbose;
    }

    /**
     * @return PHPUnit_Framework_TestCase
     */
    public function getTestSuite()
    {
        return $this->testSuite;
    }

    /**
     * @return array
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * @param string $source
     */
    public function addSource($source)
    {
        $this->sources[] = $source;
    }

    /**
     * @param string $type
     * @param string $target
     */
    public function addLogTarget($type, $target)
    {
        $this->logTargets[$type] = $target;
    }

    /**
     * @param array $browser
     */
    public function addBrowser(array $browser)
    {
        $this->browsers[] = $browser;
    }

    /**
     * @param array $directory
     */
    public function addDirectoryToBlacklistInclude(array $directory)
    {
        $this->blacklist['include']['directory'][] = $directory;
    }

    /**
     * @param string $file
     */
    public function addFileToBlacklistInclude($file)
    {
        if (!is_string($file)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->blacklist['include']['file'][] = $file;
    }

    /**
     * @param array $directory
     */
    public function addDirectoryToBlacklistExclude(array $directory)
    {
        $this->blacklist['exclude']['directory'][] = $directory;
    }

    /**
     * @param string $file
     */
    public function addFileToBlacklistExclude($file)
    {
        if (!is_string($file)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->blacklist['exclude']['file'][] = $file;
    }

    /**
     * @param array $directory
     */
    public function addDirectoryToWhitelistInclude(array $directory)
    {
        $this->whitelist['include']['directory'][] = $directory;
    }

    /**
     * @param string $file
     */
    public function addFileToWhitelistInclude($file)
    {
        if (!is_string($file)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->whitelist['include']['file'][] = $file;
    }

    /**
     * @param array $directory
     */
    public function addDirectoryToWhitelistExclude(array $directory)
    {
        $this->whitelist['exclude']['directory'][] = $directory;
    }

    /**
     * @param string $file
     */
    public function addFileToWhitelistExclude($file)
    {
        if (!is_string($file)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->whitelist['exclude']['file'][] = $file;
    }

    /**
     * @param boolean $flag
     */
    public function setCacheTokens($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->cacheTokens = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setAddUncoveredFilesFromWhitelist($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->addUncoveredFilesFromWhitelist = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setForceCoversAnnotation($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->forceCoversAnnotation = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setMapTestClassNameToCoveredClassName($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->mapTestClassNameToCoveredClassName = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setProcessUncoveredFilesFromWhitelist($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->processUncoveredFilesFromWhitelist = $flag;
    }

    /**
     * @param integer $bound
     */
    public function setReportHighLowerBound($bound)
    {
        if (!is_int($bound)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->reportHighLowerBound = $bound;
    }

    /**
     * @param integer $bound
     */
    public function setReportLowUpperBound($bound)
    {
        if (!is_int($bound)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->reportLowUpperBound = $bound;
    }

    /**
     * @param boolean $flag
     */
    public function setShowUncoveredFiles($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->showUncoveredFiles = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setShowOnlySummary($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->showOnlySummary = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setBackupGlobals($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->backupGlobals = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setBackupStaticAttributes($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->backupStaticAttributes = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setConvertErrorsToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->convertErrorsToExceptions = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setConvertNoticesToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->convertNoticesToExceptions = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setConvertWarningsToExceptions($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->convertWarningsToExceptions = $flag;
    }

    /**
     * @param string $group
     */
    public function addGroup($group)
    {
        $this->groups[] = $group;
    }

    /**
     * @param string $group
     */
    public function addExcludeGroup($group)
    {
        $this->excludeGroups[] = $group;
    }

    /**
     * @param string $filter
     */
    public function setFilter($filter)
    {
        if ($filter !== false && preg_match('/^[a-zA-Z0-9_]/', $filter)) {
            // Escape delimiters in regular expression. Do NOT use preg_quote,
            // to keep magic characters.
            $filter = '/' . str_replace('/', '\\/', $filter) . '/';
        }

        $this->filter = $filter;
    }

    /**
     * @param boolean $flag
     */
    public function setStopOnError($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnError = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setStopOnFailure($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnFailure = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setStopOnIncomplete($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnIncomplete = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setStopOnSkipped($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->stopOnSkipped = $flag;
    }

    /**
     * @param integer $timeout
     */
    public function setTimeoutForSmallTests($timeout)
    {
        if (!is_int($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->timeoutForSmallTests = $timeout;
    }

    /**
     * @param integer $timeout
     */
    public function setTimeoutForMediumTests($timeout)
    {
        if (!is_int($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->timeoutForMediumTests = $timeout;
    }

    /**
     * @param integer $timeout
     */
    public function setTimeoutForLargeTests($timeout)
    {
        if (!is_int($timeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->timeoutForLargeTests = $timeout;
    }

    /**
     * @param string $class
     */
    public function setPrinterClass($class)
    {
        if (!is_string($class)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->printerClass = $class;
    }

    /**
     * @param string $class
     */
    public function setTestSuiteLoaderClass($class)
    {
        if (!is_string($class)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->testSuiteLoaderClass = $class;
    }

    /**
     * @param string $includePath
     */
    public function addIncludePath($includePath)
    {
        if (!is_string($includePath)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->includePaths[] = $includePath;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addIniSetting($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->iniSettings[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addConstant($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->constants[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addGlobalVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->globalVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addEnvVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->envVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addPostVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->postVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addGetVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->getVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addCookieVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->cookieVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addServerVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->serverVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addFilesVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->filesVariables[$key] = $value;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addRequestVariable($key, $value)
    {
        if (!is_string($key)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->requestVariables[$key] = $value;
    }

    /**
     * @param string|false $bootstrap
     */
    public function setBootstrap($bootstrap)
    {
        if ($bootstrap !== false && !is_string($bootstrap)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
              1, 'string or false'
            );
        }

        $this->bootstrap = $bootstrap;
    }

    /**
     * @param boolean $flag
     */
    public function setColors($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->colors = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setDebug($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->debug = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setLogIncompleteSkipped($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->logIncompleteSkipped = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setProcessIsolation($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->processIsolation = $flag;
    }

    /**
     * @param integer|false $repeat
     */
    public function setRepeat($repeat)
    {
        if ($repeat !== false && !is_int($repeat)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(
              1, 'integer or false'
            );
        }

        $this->repeat = $repeat;
    }

    /**
     * @param boolean $flag
     */
    public function beStrictAboutTestsThatDoNotTestAnything($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutTestsThatDoNotTestAnything = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function beStrictAboutOutputDuringTests($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutOutputDuringTests = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function beStrictAboutTestSize($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutTestSize = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function beStrictAboutTodoAnnotatedTests($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->beStrictAboutTodoAnnotatedTests = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setCheckForUnintentionallyCoveredCode($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->checkForUnintentionallyCoveredCode = $flag;
    }

    /**
     * @param boolean $flag
     */
    public function setVerbose($flag)
    {
        if (!is_bool($flag)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->verbose = $flag;
    }

    /**
     * @param PHPUnit_Framework_TestSuite $testSuite
     */
    public function setTestSuite(PHPUnit_Framework_TestSuite $testSuite)
    {
        $this->testSuite = $testSuite;
    }

    /**
     * @param array $listener
     */
    public function addListener(array $listener)
    {
        $this->listeners[] = $listener;
    }
}
