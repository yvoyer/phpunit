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
class PHPUnit_Runner_Configuration_Loader_CLI
{
    /**
     * @var array
     */
    private $longOptions = array(
      'colors' => NULL,
      'bootstrap=' => NULL,
      'configuration=' => NULL,
      'coverage-html=' => NULL,
      'coverage-clover=' => NULL,
      'coverage-php=' => NULL,
      'coverage-text==' => NULL,
      'coverage-crap4j=' => NULL,
      'debug' => NULL,
      'exclude-group=' => NULL,
      'filter=' => NULL,
      'testsuite=' => NULL,
      'group=' => NULL,
      'help' => NULL,
      'include-path=' => NULL,
      'list-groups' => NULL,
      'loader=' => NULL,
      'log-json=' => NULL,
      'log-junit=' => NULL,
      'log-tap=' => NULL,
      'process-isolation' => NULL,
      'repeat=' => NULL,
      'stderr' => NULL,
      'stop-on-error' => NULL,
      'stop-on-failure' => NULL,
      'stop-on-incomplete' => NULL,
      'stop-on-skipped' => NULL,
      'strict' => NULL,
      'tap' => NULL,
      'testdox' => NULL,
      'testdox-html=' => NULL,
      'testdox-text=' => NULL,
      'test-suffix=' => NULL,
      'no-configuration' => NULL,
      'no-globals-backup' => NULL,
      'printer=' => NULL,
      'static-backup' => NULL,
      'verbose' => NULL,
      'version' => NULL
    );

    /**
     * Loads configuration from CLI arguments
     *
     * @param PHPUnit_Runner_Configuration $configuration
     * @param array                        $argv
     */
    public function load(PHPUnit_Runner_Configuration $configuration, array $argv)
    {
        $options = $this->getopt(
          $argv,
          'd:c:hv',
          array_keys($this->longOptions)
        );

        foreach ($this->options[0] as $option) {
            switch ($option[0]) {
                case '--colors': {
                }
                break;

                case '--bootstrap': {
                }
                break;

                case 'c':
                case '--configuration': {
                }
                break;

                case '--coverage-clover': {
                }
                break;

                case '--coverage-html': {
                }
                break;

                case '--coverage-php': {
                }
                break;

                case '--coverage-text': {
                }
                break;

                case '--coverage-crap4j': {
                }
                break;

                case 'd': {
                }
                break;

                case '--debug': {
                }
                break;

                case 'h':
                case '--help': {
                }
                break;

                case '--filter': {
                }
                break;

                case '--testsuite': {
                }
                break;

                case '--group': {
                }
                break;

                case '--exclude-group': {
                }
                break;

                case '--test-suffix': {
                }
                break;

                case '--include-path': {
                }
                break;

                case '--list-groups': {
                }
                break;

                case '--printer': {
                }
                break;

                case '--loader': {
                }
                break;

                case '--log-json': {
                }
                break;

                case '--log-junit': {
                }
                break;

                case '--log-tap': {
                }
                break;

                case '--process-isolation': {
                }
                break;

                case '--repeat': {
                }
                break;

                case '--stderr': {
                }
                break;

                case '--stop-on-error': {
                }
                break;

                case '--stop-on-failure': {
                }
                break;

                case '--stop-on-incomplete': {
                }
                break;

                case '--stop-on-skipped': {
                }
                break;

                case '--tap': {
                }
                break;

                case '--testdox': {
                }
                break;

                case '--testdox-html': {
                }
                break;

                case '--testdox-text': {
                }
                break;

                case '--no-configuration': {
                }
                break;

                case '--no-globals-backup': {
                }
                break;

                case '--static-backup': {
                }
                break;

                case 'v':
                case '--verbose': {
                }
                break;

                case '--version': {
                }
                break;

                case '--strict': {
                }
                break;
            }
        }
    }

    private function getopt(array $args, $short_options, $long_options = NULL)
    {
        if (empty($args)) {
            return array(array(), array());
        }

        $opts     = array();
        $non_opts = array();

        if ($long_options) {
            sort($long_options);
        }

        if (isset($args[0][0]) && $args[0][0] != '-') {
            array_shift($args);
        }

        reset($args);
        array_map('trim', $args);

        while (list($i, $arg) = each($args)) {
            if ($arg == '') {
                continue;
            }

            if ($arg == '--') {
                $non_opts = array_merge($non_opts, array_slice($args, $i + 1));
                break;
            }

            if ($arg[0] != '-' ||
                (strlen($arg) > 1 && $arg[1] == '-' && !$long_options)) {
                $non_opts = array_merge($non_opts, array_slice($args, $i));
                break;
            }

            elseif (strlen($arg) > 1 && $arg[1] == '-') {
                $this->parseLongOption(
                  substr($arg, 2), $long_options, $opts, $args
                );
            }

            else {
                $this->parseShortOption(
                  substr($arg, 1), $short_options, $opts, $args
                );
            }
        }

        return array($opts, $non_opts);
    }

    private function parseShortOption($arg, $short_options, &$opts, &$args)
    {
        $argLen = strlen($arg);

        for ($i = 0; $i < $argLen; $i++) {
            $opt     = $arg[$i];
            $opt_arg = NULL;

            if (($spec = strstr($short_options, $opt)) === FALSE ||
                $arg[$i] == ':') {
                throw new PHPUnit_Runner_Exception(
                  "unrecognized option -- $opt"
                );
            }

            if (strlen($spec) > 1 && $spec[1] == ':') {
                if (strlen($spec) > 2 && $spec[2] == ':') {
                    if ($i + 1 < $argLen) {
                        $opts[] = array($opt, substr($arg, $i + 1));
                        break;
                    }
                } else {
                    if ($i + 1 < $argLen) {
                        $opts[] = array($opt, substr($arg, $i + 1));
                        break;
                    }

                    else if (list(, $opt_arg) = each($args)) {
                    }

                    else {
                        throw new PHPUnit_Runner_Exception(
                          "option requires an argument -- $opt"
                        );
                    }
                }
            }

            $opts[] = array($opt, $opt_arg);
        }
    }

    private function parseLongOption($arg, $long_options, &$opts, &$args)
    {
        $count   = count($long_options);
        $list    = explode('=', $arg);
        $opt     = $list[0];
        $opt_arg = NULL;

        if (count($list) > 1) {
            $opt_arg = $list[1];
        }

        $opt_len = strlen($opt);

        for ($i = 0; $i < $count; $i++) {
            $long_opt  = $long_options[$i];
            $opt_start = substr($long_opt, 0, $opt_len);

            if ($opt_start != $opt) {
                continue;
            }

            $opt_rest = substr($long_opt, $opt_len);

            if ($opt_rest != '' && $opt[0] != '=' && $i + 1 < $count &&
                $opt == substr($long_options[$i+1], 0, $opt_len)) {
                throw new PHPUnit_Runner_Exception(
                  "option --$opt is ambiguous"
                );
            }

            if (substr($long_opt, -1) == '=') {
                if (substr($long_opt, -2) != '==') {
                    if (!strlen($opt_arg) &&
                        !(list(, $opt_arg) = each($args))) {
                        throw new PHPUnit_Runner_Exception(
                          "option --$opt requires an argument"
                        );
                    }
                }
            }

            else if ($opt_arg) {
                throw new PHPUnit_Runner_Exception(
                  "option --$opt doesn't allow an argument"
                );
            }

            $opts[] = array('--' . $opt, $opt_arg);
            return;
        }

        throw new PHPUnit_Runner_Exception("unrecognized option --$opt");
    }
}
