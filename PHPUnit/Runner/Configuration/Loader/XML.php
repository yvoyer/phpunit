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
class PHPUnit_Runner_Configuration_Loader_XML
{
    /**
     * Loads configuration from an XML file
     *
     * @param PHPUnit_Runner_Configuration $configuration
     * @param string                       $filename
     */
    public function load(PHPUnit_Runner_Configuration $configuration, $filename)
    {
        $filename              = realpath($filename);
        $configurationFilePath = dirname($filename);
        $document              = PHPUnit_Util_XML::loadFile($filename, FALSE, TRUE);
        $xpath                 = new DOMXPath($document);

        $this->handleFilterConfiguration($configuration, $xpath, $configurationFilePath);
        $this->handleGroupConfiguration($configuration, $xpath);
        $this->handleListenerConfiguration($configuration, $xpath);
        $this->handleLoggingConfiguration($configuration, $xpath, $configurationFilePath);
        $this->handlePhpConfiguration($configuration, $xpath, $configurationFilePath);
        $this->handleRunnerConfiguration($configuration, $document->documentElement, $configurationFilePath);
        $this->handleSeleniumConfiguration($configuration, $xpath);
        $this->handleTestSuiteConfiguration($configuration, $xpath, $configurationFilePath);

        $configuration->addSource($filename);
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     * @param string                       $configurationFilePath
     */
    private function handleFilterConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath, $configurationFilePath)
    {
        $tmp = $xpath->query('filter/whitelist');

        if ($tmp->length == 1) {
            if ($tmp->item(0)->hasAttribute('addUncoveredFilesFromWhitelist')) {
                $this->setBoolean(
                  $configuration,
                  'setAddUncoveredFilesFromWhitelist',
                  (string)$tmp->item(0)->getAttribute(
                    'addUncoveredFilesFromWhitelist'
                  )
                );
            }

            if ($tmp->item(0)->hasAttribute('processUncoveredFilesFromWhitelist')) {
                $this->setBoolean(
                  $configuration,
                  'setProcessUncoveredFilesFromWhitelist',
                  (string)$tmp->item(0)->getAttribute(
                    'processUncoveredFilesFromWhitelist'
                  )
                );
            }
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/blacklist/directory', $configurationFilePath) as $dir) {
            $configuration->addDirectoryToBlacklistInclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/blacklist/file', $configurationFilePath) as $file) {
            $configuration->addFileToBlacklistInclude($file);
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/blacklist/exclude/directory', $configurationFilePath) as $dir) {
            $configuration->addDirectoryToBlacklistExclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/blacklist/exclude/file', $configurationFilePath) as $file) {
            $configuration->addFileToBlacklistExclude($file);
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/whitelist/directory', $configurationFilePath) as $dir) {
            $configuration->addDirectoryToWhitelistInclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/whitelist/file', $configurationFilePath) as $file) {
            $configuration->addFileToWhitelistInclude($file);
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/whitelist/exclude/directory', $configurationFilePath) as $dir) {
            $configuration->addDirectoryToWhitelistExclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/whitelist/exclude/file', $configurationFilePath) as $file) {
            $configuration->addFileToWhitelistExclude($file);
        }
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     */
    private function handleGroupConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath)
    {
        foreach ($xpath->query('groups/include/group') as $group) {
            $configuration->addGroup((string)$group->nodeValue);
        }

        foreach ($xpath->query('groups/exclude/group') as $group) {
            $configuration->addExcludeGroup((string)$group->nodeValue);
        }
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     */
    private function handleListenerConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath)
    {
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     * @param string                       $configurationFilePath
     */
    private function handleLoggingConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath, $configurationFilePath)
    {
        foreach ($xpath->query('logging/log') as $log) {
            $type = (string)$log->getAttribute('type');

            $target = $this->toAbsolutePath(
              (string)$log->getAttribute('target'),
              $configurationFilePath
            );

            $configuration->addLogTarget($type, $target);

            switch ($type) {
                case 'coverage-html': {
                    if ($log->hasAttribute('charset')) {
                        $configuration->setReportCharset(
                          (string)$log->getAttribute('charset')
                        );
                    }

                    if ($log->hasAttribute('highlight')) {
                        $this->setBoolean(
                          $configuration,
                          'setReportHighlight',
                          (string)$log->getAttribute(
                            'highlight'
                          )
                        );
                    }

                    if ($log->hasAttribute('lowUpperBound')) {
                        $this->setInteger(
                          $configuration,
                          'setReportLowUpperBound',
                          (string)$log->getAttribute(
                            'lowUpperBound'
                          )
                        );
                    }

                    if ($log->hasAttribute('highLowerBound')) {
                        $this->setInteger(
                          $configuration,
                          'setReportHighLowerBound',
                          (string)$log->getAttribute(
                            'highLowerBound'
                          )
                        );
                    }
                }
                break;

                case 'coverage-text': {
                    if ($log->hasAttribute('showUncoveredFiles')) {
                        $this->setBoolean(
                          $configuration,
                          'setShowUncoveredFiles',
                          (string)$log->getAttribute(
                            'showUncoveredFiles'
                          )
                        );
                    }

                    if ($log->hasAttribute('showOnlySummary')) {
                        $this->setBoolean(
                          $configuration,
                          'setShowOnlySummary',
                          (string)$log->getAttribute(
                            'showOnlySummary'
                          )
                        );
                    }
                }
                break;

                case 'junit': {
                    if ($log->hasAttribute('logIncompleteSkipped')) {
                        $this->setBoolean(
                          $configuration,
                          'setLogIncompleteSkipped',
                          (string)$log->getAttribute(
                            'logIncompleteSkipped'
                          )
                        );
                    }
                }
                break;
            }
        }
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     * @param string                       $configurationFilePath
     */
    private function handlePhpConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath, $configurationFilePath)
    {
        foreach ($xpath->query('php/includePath') as $includePath) {
            $configuration->addIncludePath(
              $this->toAbsolutePath(
                (string)$includePath->nodeValue,
                $configurationFilePath
              )
            );
        }

        foreach ($xpath->query('php/ini') as $ini) {
            $configuration->addIniSetting(
              (string)$ini->getAttribute('name'),
              (string)$ini->getAttribute('value')
            );
        }

        foreach ($xpath->query('php/const') as $const) {
            $configuration->addConstant(
              (string)$const->getAttribute('name'),
              $this->getBoolean((string)$const->getAttribute('value'))
            );
        }

        foreach (array('var', 'env', 'post', 'get', 'cookie', 'server', 'files', 'request') as $array) {
            foreach ($xpath->query('php/' . $array) as $var) {
                $name  = (string)$var->getAttribute('name');
                $value = $this->getBoolean((string)$var->getAttribute('value'));

                if ($array == 'var') {
                    $method = 'addGlobalVariable';
                } else {
                    $method = 'add' . ucfirst($array) . 'Variable';
                }

                $configuration->$method($name, $value);
            }
        }
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMElement                   $root
     * @param string                       $configurationFilePath
     */
    private function handleRunnerConfiguration(PHPUnit_Runner_Configuration $configuration, DOMElement $root, $configurationFilePath)
    {
        if ($root->hasAttribute('cacheTokens')) {
            $this->setBoolean(
              $configuration,
              'setCacheTokens',
              (string)$root->getAttribute('cacheTokens')
            );
        }

        if ($root->hasAttribute('colors')) {
            $this->setBoolean(
              $configuration,
              'setColors',
              (string)$root->getAttribute('colors')
            );
        }

        if ($root->hasAttribute('backupGlobals')) {
            $this->setBoolean(
              $configuration,
              'setBackupGlobals',
              (string)$root->getAttribute('backupGlobals')
            );
        }

        if ($root->hasAttribute('backupStaticAttributes')) {
            $this->setBoolean(
              $configuration,
              'setBackupStaticAttributes',
              (string)$root->getAttribute('backupStaticAttributes')
            );
        }

        if ($root->hasAttribute('convertErrorsToExceptions')) {
            $this->setBoolean(
              $configuration,
              'setConvertErrorsToExceptions',
              (string)$root->getAttribute('convertErrorsToExceptions')
            );
        }

        if ($root->hasAttribute('convertNoticesToExceptions')) {
            $this->setBoolean(
              $configuration,
              'setConvertNoticesToExceptions',
              (string)$root->getAttribute('convertNoticesToExceptions')
            );
        }

        if ($root->hasAttribute('convertWarningsToExceptions')) {
            $this->setBoolean(
              $configuration,
              'setConvertWarningsToExceptions',
              (string)$root->getAttribute('convertWarningsToExceptions')
            );
        }

        if ($root->hasAttribute('forceCoversAnnotation')) {
            $this->setBoolean(
              $configuration,
              'setForceCoversAnnotation',
              (string)$root->getAttribute('forceCoversAnnotation')
            );
        }

        if ($root->hasAttribute('mapTestClassNameToCoveredClassName')) {
            $this->setBoolean(
              $configuration,
              'setMapTestClassNameToCoveredClassName',
              (string)$root->getAttribute('mapTestClassNameToCoveredClassName')
            );
        }

        if ($root->hasAttribute('processIsolation')) {
            $this->setBoolean(
              $configuration,
              'setProcessIsolation',
              (string)$root->getAttribute('processIsolation')
            );
        }

        if ($root->hasAttribute('stopOnError')) {
            $this->setBoolean(
              $configuration,
              'setStopOnError',
              (string)$root->getAttribute('stopOnError')
            );
        }

        if ($root->hasAttribute('stopOnFailure')) {
            $this->setBoolean(
              $configuration,
              'setStopOnFailure',
              (string)$root->getAttribute('stopOnFailure')
            );
        }

        if ($root->hasAttribute('stopOnIncomplete')) {
            $this->setBoolean(
              $configuration,
              'setStopOnIncomplete',
              (string)$root->getAttribute('stopOnIncomplete')
            );
        }

        if ($root->hasAttribute('stopOnSkipped')) {
            $this->setBoolean(
              $configuration,
              'setStopOnSkipped',
              (string)$root->getAttribute('stopOnSkipped')
            );
        }

        if ($root->hasAttribute('strict')) {
            $this->setBoolean(
              $configuration,
              'setStrict',
              (string)$root->getAttribute('strict')
            );
        }

        if ($root->hasAttribute('verbose')) {
            $this->setBoolean(
              $configuration,
              'setVerbose',
              (string)$root->getAttribute('verbose')
            );
        }

        if ($root->hasAttribute('timeoutForSmallTests')) {
            $this->setInteger(
              $configuration,
              'setTimeoutForSmallTests',
              (string)$root->getAttribute('timeoutForSmallTests')
            );
        }

        if ($root->hasAttribute('timeoutForMediumTests')) {
            $this->setInteger(
              $configuration,
              'setTimeoutForMediumTests',
              (string)$root->getAttribute('timeoutForMediumTests')
            );
        }

        if ($root->hasAttribute('timeoutForLargeTests')) {
            $this->setInteger(
              $configuration,
              'setTimeoutForLargeTests',
              (string)$root->getAttribute('timeoutForLargeTests')
            );
        }

        if ($root->hasAttribute('bootstrap')) {
            $configuration->setBootstrap(
              $this->toAbsolutePath(
                (string)$root->getAttribute('bootstrap'),
                $configurationFilePath
              )
            );
        }

        if ($root->hasAttribute('testSuiteLoaderClass')) {
            $configuration->setTestSuiteLoaderClass(
              (string)$root->getAttribute(
                'testSuiteLoaderClass'
              )
            );
        }

        if ($root->hasAttribute('testSuiteLoaderFile')) {
            $configuration->setTestSuiteLoaderFile(
              $this->toAbsolutePath(
                (string)$root->getAttribute(
                  'testSuiteLoaderFile'
                ),
                $configurationFilePath
              )
            );
        }

        if ($root->hasAttribute('printerClass')) {
            $configuration->setPrinterClass(
              (string)$root->getAttribute('printerClass')
            );
        }

        if ($root->hasAttribute('printerFile')) {
            $configuration->setPrinterFile(
              $this->toAbsolutePath(
                (string)$root->getAttribute('printerFile'),
                $configurationFilePath
              )
            );
        }
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     */
    private function handleSeleniumConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath)
    {
        foreach ($xpath->query('selenium/browser') as $config) {
            $name    = (string)$config->getAttribute('name');
            $browser = (string)$config->getAttribute('browser');

            $host    = 'localhost';
            $port    = 4444;
            $timeout = 30000;

            if ($config->hasAttribute('host')) {
                $host = (string)$config->getAttribute('host');
            }

            if ($config->hasAttribute('port')) {
                $tmp = (string)$config->getAttribute('port');

                if (is_numeric($tmp)) {
                    $port = (int)$tmp;
                }
            }

            if ($config->hasAttribute('timeout')) {
                $tmp = (string)$config->getAttribute('timeout');

                if (is_numeric($tmp)) {
                    $timeout = (int)$tmp;
                }
            }

            $configuration->addBrowser(
              array(
                'name'    => $name,
                'browser' => $browser,
                'host'    => $host,
                'port'    => $port,
                'timeout' => $timeout
              )
            );
        }
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMXPath                     $xpath
     * @param string                       $configurationFilePath
     */
    private function handleTestSuiteConfiguration(PHPUnit_Runner_Configuration $configuration, DOMXPath $xpath, $configurationFilePath)
    {
        $testSuiteNodes = $xpath->query('testsuites/testsuite');

        if ($testSuiteNodes->length == 0) {
            $testSuiteNodes = $xpath->query('testsuite');
        }

        if ($testSuiteNodes->length == 1) {
            $configuration->setTestSuite(
              $this->getTestSuite(
                $testSuiteNodes->item(0), $configurationFilePath
              )
            );
        }

        if ($testSuiteNodes->length > 1) {
            $suite = new PHPUnit_Framework_TestSuite;

            foreach ($testSuiteNodes as $testSuiteNode) {
                $suite->addTestSuite(
                  $this->getTestSuite($testSuiteNode, $configurationFilePath)
                );
            }

            $configuration->setTestSuite($suite);
        }
    }

    /**
     * @param  DOMElement $testSuiteNode
     * @param  string     $configurationFilePath
     * @return PHPUnit_Framework_TestSuite
     */
    private function getTestSuite(DOMElement $testSuiteNode, $configurationFilePath)
    {
        if ($testSuiteNode->hasAttribute('name')) {
            $suite = new PHPUnit_Framework_TestSuite(
              (string)$testSuiteNode->getAttribute('name')
            );
        } else {
            $suite = new PHPUnit_Framework_TestSuite;
        }

        $exclude = array();

        foreach ($testSuiteNode->getElementsByTagName('exclude') as $excludeNode) {
            $exclude[] = $this->toAbsolutePath(
              (string)$excludeNode->nodeValue, $configurationFilePath
            );
        }

        $fileIteratorFacade = new File_Iterator_Facade;

        foreach ($testSuiteNode->getElementsByTagName('directory') as $directoryNode) {
            $directory = (string)$directoryNode->nodeValue;

            if (empty($directory)) {
                continue;
            }

            if ($directoryNode->hasAttribute('phpVersion')) {
                $phpVersion = (string)$directoryNode->getAttribute('phpVersion');
            } else {
                $phpVersion = PHP_VERSION;
            }

            if ($directoryNode->hasAttribute('phpVersionOperator')) {
                $phpVersionOperator = (string)$directoryNode->getAttribute('phpVersionOperator');
            } else {
                $phpVersionOperator = '>=';
            }

            if (!version_compare(PHP_VERSION, $phpVersion, $phpVersionOperator)) {
                continue;
            }

            if ($directoryNode->hasAttribute('prefix')) {
                $prefix = (string)$directoryNode->getAttribute('prefix');
            } else {
                $prefix = '';
            }

            if ($directoryNode->hasAttribute('suffix')) {
                $suffix = (string)$directoryNode->getAttribute('suffix');
            } else {
                $suffix = 'Test.php';
            }

            $files = $fileIteratorFacade->getFilesAsArray(
              $this->toAbsolutePath($directory, $configurationFilePath),
              $suffix,
              $prefix,
              $exclude
            );

            $suite->addTestFiles($files);
        }

        foreach ($testSuiteNode->getElementsByTagName('file') as $fileNode) {
            $file = (string)$fileNode->nodeValue;

            if (empty($file)) {
                continue;
            }

            $file = $fileIteratorFacade->getFilesAsArray(
              $this->toAbsolutePath($file, $configurationFilePath)
            );

            if (!isset($file[0])) {
                continue;
            }

            $file = $file[0];

            if ($fileNode->hasAttribute('phpVersion')) {
                $phpVersion = (string)$fileNode->getAttribute('phpVersion');
            } else {
                $phpVersion = PHP_VERSION;
            }

            if ($fileNode->hasAttribute('phpVersionOperator')) {
                $phpVersionOperator = (string)$fileNode->getAttribute('phpVersionOperator');
            } else {
                $phpVersionOperator = '>=';
            }

            if (!version_compare(PHP_VERSION, $phpVersion, $phpVersionOperator)) {
                continue;
            }

            $suite->addTestFile($file);
        }

        return $suite;
    }

    /**
     * @param  mixed $value
     * @return mixed
     */
    private function getBoolean($value)
    {
        if (strtolower($value) == 'false') {
            return FALSE;
        }

        else if (strtolower($value) == 'true') {
            return TRUE;
        }

        return $value;
    }

    /**
     * @param  PHPUnit_Runner_Configuration $configuration
     * @param  string                       $method
     * @param  mixed                        $value
     * @return boolean
     */
    private function setBoolean(PHPUnit_Runner_Configuration $configuration, $method, $value)
    {
        $value = $this->getBoolean($value);

        if (is_bool($value)) {
            $configuration->$method($value);
        }
    }

    /**
     * @param  PHPUnit_Runner_Configuration $configuration
     * @param  string                       $method
     * @param  mixed                        $value
     * @return boolean
     */
    private function setInteger(PHPUnit_Runner_Configuration $configuration, $method, $value)
    {
        if (is_numeric($value)) {
            $configuration->$method((int)$value);
        }
    }

    /**
     * @param  DOMXPath $xpath
     * @param  string   $query
     * @param  string   $configurationFilePath
     * @return array
     */
    private function readFilterDirectories(DOMXPath $xpath, $query, $configurationFilePath)
    {
        $directories = array();

        foreach ($xpath->query($query) as $directory) {
            if ($directory->hasAttribute('prefix')) {
                $prefix = (string)$directory->getAttribute('prefix');
            } else {
                $prefix = '';
            }

            if ($directory->hasAttribute('suffix')) {
                $suffix = (string)$directory->getAttribute('suffix');
            } else {
                $suffix = '.php';
            }

            if ($directory->hasAttribute('group')) {
                $group = (string)$directory->getAttribute('group');
            } else {
                $group = 'DEFAULT';
            }

            $directories[] = array(
              'path'   => $this->toAbsolutePath(
                            (string)$directory->nodeValue,
                            $configurationFilePath
                          ),
              'prefix' => $prefix,
              'suffix' => $suffix,
              'group'  => $group
            );
        }

        return $directories;
    }

    /**
     * @param  DOMXPath $xpath
     * @param  string   $query
     * @param  string   $configurationFilePath
     * @return array
     */
    private function readFilterFiles(DOMXPath $xpath, $query, $configurationFilePath)
    {
        $files = array();

        foreach ($xpath->query($query) as $file) {
            $files[] = $this->toAbsolutePath(
              (string)$file->nodeValue,
              $configurationFilePath
            );
        }

        return $files;
    }

    /**
     * @param  string  $path
     * @param  string  $configurationFilePath
     * @param  boolean $useIncludePath
     * @return string
     */
    private function toAbsolutePath($path, $configurationFilePath, $useIncludePath = FALSE)
    {
        // Check whether the path is already absolute.
        if ($path[0] === '/' || $path[0] === '\\' ||
            (strlen($path) > 3 && ctype_alpha($path[0]) &&
            $path[1] === ':' && ($path[2] === '\\' || $path[2] === '/'))) {
            return $path;
        }

        // Check whether a stream is used.
        if (strpos($path, '://') !== FALSE) {
            return $path;
        }

        $file = $configurationFilePath . DIRECTORY_SEPARATOR . $path;

        if ($useIncludePath && !file_exists($file)) {
            $includePathFile = stream_resolve_include_path($path);

            if ($includePathFile) {
                $file = $includePathFile;
            }
        }

        return $file;
    }
}
