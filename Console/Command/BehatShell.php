<?php
define('BEHAT_PHP_BIN_PATH', '/usr/bin/env php');
define('BEHAT_BIN_PATH', __FILE__);
define('BEHAT_VERSION', 'DEV');

App::uses('Shell', 'Console');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

App::uses('behat/behat', 'Vendor');
App::uses('behat/mink', 'Vendor');
App::uses('behat/mink-extension', 'Vendor');

/**
 * Behat shell.
 */
class BehatShell extends Shell {

    /**
     * Behat Application Object
     *
     * @Object
     */
    public $behatApp;

    /**
     * Override startup
     *
     * @return void
     */
    public function startup() {
        $this->out('Cake Behat Shell');
        $this->hr();
    }

    /**
     * Install method
     *
     * @return void
     */
    public function install() {
        // Setup Behat Console
        $file = new File($this->_getPath() . DS . 'skel' . DS . 'behat');
        $this->out('Copying behat to App/Console...');
        $file->copy(APP . 'Console'.  DS . 'behat');
        // Setup Behat Config
        $file = new File($this->_getPath() . DS . 'skel' . DS . 'behat.yml');
        $this->out('Copying behat.yml to App/Config...');
        $file->copy(APP . 'Config'.  DS . 'behat.yml');
        // Setup features dir
        $folder = new Folder($this->_getPath() . DS . 'skel' . DS . 'features');
        $this->out('Copying features dir into Application Root...');
        $folder->copy(array('to' => APP . 'features'));
    }

    /**
     * Override main
     *
     * @return void
     */
    public function main() {
        // Internal encoding to utf8
        mb_internal_encoding('utf8');
        // Get rid of Cake default args
        $args = $this->_cleanArgs($_SERVER['argv']);
        // Create instance of BehatApplication
        $this->behatApp = new Behat\Behat\Console\BehatApplication(BEHAT_VERSION);

        if(!in_array('--config', $args) && !in_array('-c', $args) && !$this->_isCommand($args)) {
            array_push($args, '--config', APP . 'Config' . DS . 'behat.yml');
        }
        $this->behatApp->run(new Symfony\Component\Console\Input\ArgvInput($args));
    }

    /**
     * get the option parser.
     *
     * @return BehatConsoleOptionParser
     */
    public function getOptionParser() {
        return new BehatConsoleOptionParser($this->name);
    }

    /**
     * Arguments cleaning
     *
     * @param array $args
     * @return array
     */
    protected function _cleanArgs($args) {
        while ($args[0] != 'Behat.behat') {
            array_shift($args);
        }
        return $args;
    }

    /**
     * Check if one of the args is a Behat option or shortcut
     *
     * @param array $args
     * @return boolean
     */
    protected function _isCommand($args) {
        $isCommand = false;
        $definition = $this->behatApp->getDefinition();
        foreach($args as $arg) {
            $arg = str_replace("-", "", $arg);
            if($definition->hasOption($arg) || $definition->hasShortcut($arg)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Return the path used
     *
     * @return string Path used
     */
    protected function _getPath() {
        return App::pluginPath('Behat');
    }
}

/**
 * BehatConsoleOptionParser
 *
 * Stub to suppress processing of incoming console commands
 */
class BehatConsoleOptionParser extends ConsoleOptionParser {
    /**
     * @param array $argv
     * @param null|string $command
     * @return array
     */
    public function parse($argv, $command = null) {
        $params = $args = array();
        return array($params, $args);
    }
}
