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
        $document = PHPUnit_Util_XML::loadFile($filename, FALSE, TRUE);
        $xpath    = new DOMXPath($document);

        $this->handleFilterConfiguration($configuration, $document, $xpath);
    }

    /**
     * @param PHPUnit_Runner_Configuration $configuration
     * @param DOMDocument                  $document
     * @param DOMXPath                     $xpath
     */
    private function handleFilterConfiguration(PHPUnit_Runner_Configuration $configuration, DOMDocument $document, DOMXPath $xpath)
    {
        $tmp = $xpath->query('filter/whitelist');

        if ($tmp->length == 1) {
            if ($tmp->item(0)->hasAttribute('addUncoveredFilesFromWhitelist')) {
                $flag = $this->getBoolean(
                  (string)$tmp->item(0)->getAttribute(
                    'addUncoveredFilesFromWhitelist'
                  )
                );

                if (is_bool($flag)) {
                    $configuration->setAddUncoveredFilesFromWhitelist($flag);
                }
            }

            if ($tmp->item(0)->hasAttribute('processUncoveredFilesFromWhitelist')) {
                $processUncoveredFilesFromWhitelist = $this->getBoolean(
                  (string)$tmp->item(0)->getAttribute(
                    'processUncoveredFilesFromWhitelist'
                  )
                );

                if (is_bool($flag)) {
                    $configuration->setProcessUncoveredFilesFromWhitelist($flag);
                }
            }
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/blacklist/directory') as $dir) {
            $configuration->addDirectoryToBlacklistInclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/blacklist/file') as $file) {
            $configuration->addFileToBlacklistInclude($file);
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/blacklist/exclude/directory') as $dir) {
            $configuration->addDirectoryToBlacklistExclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/blacklist/exclude/file') as $file) {
            $configuration->addFileToBlacklistExclude($file);
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/whitelist/directory') as $dir) {
            $configuration->addDirectoryToWhitelistInclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/whitelist/file') as $file) {
            $configuration->addFileToWhitelistInclude($file);
        }

        foreach ($this->readFilterDirectories($xpath, 'filter/whitelist/exclude/directory') as $dir) {
            $configuration->addDirectoryToWhitelistExclude($dir);
        }

        foreach ($this->readFilterFiles($xpath, 'filter/whitelist/exclude/file') as $file) {
            $configuration->addFileToWhitelistExclude($file);
        }
    }

    /**
     * @param  string $value
     * @return boolean
     */
    private function getBoolean($value)
    {
        if (strtolower($value) == 'false') {
            return FALSE;
        }

        else if (strtolower($value) == 'true') {
            return TRUE;
        }
    }

    /**
     * @param  string $value
     * @return boolean
     */
    private function getInteger($value)
    {
        if (is_numeric($value)) {
            return (int)$value;
        }
    }

    /**
     * @param  DOMXPath $xpath
     * @param  string   $query
     * @return array
     */
    private function readFilterDirectories(DOMXPath $xpath, $query)
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
              'path'   => $this->toAbsolutePath((string)$directory->nodeValue),
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
     * @return array
     */
    private function readFilterFiles(DOMXPath $xpath, $query)
    {
        $files = array();

        foreach ($xpath->query($query) as $file) {
            $files[] = $this->toAbsolutePath((string)$file->nodeValue);
        }

        return $files;
    }

    /**
     * @param  string  $path
     * @param  boolean $useIncludePath
     * @return string
     */
    private function toAbsolutePath($path, $useIncludePath = FALSE)
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

        $file = dirname($this->filename) . DIRECTORY_SEPARATOR . $path;

        if ($useIncludePath && !file_exists($file)) {
            $includePathFile = stream_resolve_include_path($path);

            if ($includePathFile) {
                $file = $includePathFile;
            }
        }

        return $file;
    }
}