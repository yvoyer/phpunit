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
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.8.0
 */

/**
 *
 *
 * @package    PHPUnit
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2001-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.8.0
 * @covers     PHPUnit_Runner_Configuration_Loader_XML
 */
class Runner_Configuration_Loader_XMLTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Runner_Configuration
     */
    private $configuration;

    /**
     * @var PHPUnit_Runner_Configuration_Loader_XML
     */
    private $loader;

    protected function setUp()
    {
        $this->configuration = PHPUnit_Runner_Configuration::getInstance();
        $this->loader        = new PHPUnit_Runner_Configuration_Loader_XML;
    }

    /**
     * @backupStaticAttributes enabled
     */
    public function testConfigurationCanBeLoadedFromXMLFile()
    {
        $file = __DIR__ . '/../../../_files/configuration.xml';

        $this->loader->load($this->configuration, $file);

        $this->assertEquals(
          array(realpath($file)),
          $this->configuration->getSources()
        );

        $this->assertTrue($this->configuration->getAddUncoveredFilesFromWhitelist());
        $this->assertFalse($this->configuration->getProcessUncoveredFilesFromWhitelist());

        $this->assertEquals(
          array(
            'include' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            ),
            'exclude' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            )
          ),
          $this->configuration->getBlacklist()
        );

        $this->assertEquals(
          array(
            'include' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            ),
            'exclude' => array(
              'directory' => array(
                array(
                  'path'   => '/path/to/files',
                  'prefix' => '',
                  'suffix' => '.php',
                  'group'  => 'DEFAULT'
                )
              ),
              'file' => array(
                '/path/to/file'
              )
            )
          ),
          $this->configuration->getWhitelist()
        );

        $this->assertEquals(array('name'), $this->configuration->getGroups());
        $this->assertEquals(array('name'), $this->configuration->getExcludeGroups());

        $this->assertFalse($this->configuration->getCacheTokens());
        $this->assertFalse($this->configuration->getColors());
        $this->assertTrue($this->configuration->getBackupGlobals());
        $this->assertFalse($this->configuration->getBackupStaticAttributes());
        $this->assertTrue($this->configuration->getConvertErrorsToExceptions());
        $this->assertTrue($this->configuration->getConvertNoticesToExceptions());
        $this->assertTrue($this->configuration->getConvertWarningsToExceptions());
        $this->assertFalse($this->configuration->getForceCoversAnnotation());
        $this->assertFalse($this->configuration->getMapTestClassNameToCoveredClassName());
        $this->assertFalse($this->configuration->getProcessIsolation());
        $this->assertFalse($this->configuration->getStopOnError());
        $this->assertFalse($this->configuration->getStopOnFailure());
        $this->assertFalse($this->configuration->getStopOnIncomplete());
        $this->assertFalse($this->configuration->getStopOnSkipped());
        $this->assertFalse($this->configuration->getStrict());
        $this->assertFalse($this->configuration->getVerbose());

        $this->assertEquals(1, $this->configuration->getTimeoutForSmallTests());
        $this->assertEquals(10, $this->configuration->getTimeoutForMediumTests());
        $this->assertEquals(60, $this->configuration->getTimeoutForLargeTests());

        $this->assertEquals('/path/to/bootstrap.php', $this->configuration->getBootstrap());
        $this->assertEquals('PHPUnit_Runner_StandardTestSuiteLoader', $this->configuration->getTestSuiteLoaderClass());
        $this->assertEquals('PHPUnit_TextUI_ResultPrinter', $this->configuration->getPrinterClass());

        $this->assertEquals(array(realpath(__DIR__ . '/../../../_files') . '/.', '/path/to/lib'), $this->configuration->getIncludePaths());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getIniSettings());
        $this->assertEquals(array('FOO' => FALSE, 'BAR' => TRUE), $this->configuration->getConstants());
        $this->assertEquals(array('foo' => FALSE), $this->configuration->getGlobalVariables());
        $this->assertEquals(array('foo' => TRUE), $this->configuration->getEnvVariables());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getPostVariables());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getGetVariables());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getCookieVariables());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getServerVariables());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getFilesVariables());
        $this->assertEquals(array('foo' => 'bar'), $this->configuration->getRequestVariables());

        $this->assertEquals(
          array(
            'coverage-html' => '/tmp/report',
            'coverage-clover' => '/tmp/clover.xml',
            'json' => '/tmp/logfile.json',
            'plain' => '/tmp/logfile.txt',
            'tap' => '/tmp/logfile.tap',
            'junit' => '/tmp/logfile.xml',
            'testdox-html' => '/tmp/testdox.html',
            'testdox-text' => '/tmp/testdox.txt'
          ),
          $this->configuration->getLogTargets()
        );

        $this->assertEquals('UTF-8', $this->configuration->getReportCharset());
        $this->assertFalse($this->configuration->getReportHighlight());
        $this->assertEquals(35, $this->configuration->getReportLowUpperBound());
        $this->assertEquals(70, $this->configuration->getReportHighLowerBound());
        $this->assertFalse($this->configuration->getShowUncoveredFiles());
        $this->assertFalse($this->configuration->getShowOnlySummary());
        $this->assertFalse($this->configuration->getLogIncompleteSkipped());

        $this->assertEquals(
          array(
            array(
              'name' => 'Firefox on Linux',
              'browser' => '*firefox /usr/lib/firefox/firefox-bin',
              'host' => 'my.linux.box',
              'port' => 4444,
              'timeout' => 30000
            )
          ),
          $this->configuration->getBrowsers()
        );

        // TODO: Improve assertion
        $this->assertInstanceOf(
          'PHPUnit_Framework_TestSuite', $this->configuration->getTestSuite()
        );
    }
}
