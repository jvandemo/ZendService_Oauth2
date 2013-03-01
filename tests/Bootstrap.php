<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend
 */

/*
 * Set error reporting to the level to which Zend Framework code must comply.
 */
error_reporting( E_ALL | E_STRICT );

$phpUnitVersion = PHPUnit_Runner_Version::id();
if ('@package_version@' !== $phpUnitVersion && version_compare($phpUnitVersion, '3.5.0', '<')) {
    echo 'This version of PHPUnit (' . PHPUnit_Runner_Version::id() . ') is not supported in Zend Framework 2.x unit tests.' . PHP_EOL;
    exit(1);
}
echo 'Running PHPUnit Runner version ' . $phpUnitVersion;
unset($phpUnitVersion);

/*
 * Determine the root, library, and tests directories of the framework
 * distribution.
 */
$zendServiceRoot        = realpath(dirname(__DIR__));
$zendServiceCoreLibrary = "$zendServiceRoot/library";
$zendServiceCoreTests   = "$zendServiceRoot/tests";

/*
 * Prepend the Zend Framework library/ and tests/ directories to the
 * include_path. This allows the tests to run out of the box and helps prevent
 * loading other copies of the framework code and tests that would supersede
 * this copy.
 */
$path = array(
    $zendServiceCoreLibrary,
    $zendServiceCoreTests,
    get_include_path(),
);
set_include_path(implode(PATH_SEPARATOR, $path));

/**
 * Setup autoloading
 */
include __DIR__ . '/Autoload/_autoload.php';

/*
 * Load the user-defined test configuration file, if it exists; otherwise, load
 * the default configuration.
 */
if (is_readable($zendServiceCoreTests . DIRECTORY_SEPARATOR . 'config.local.php')) {
    $config = include $zendServiceCoreTests . DIRECTORY_SEPARATOR . 'config.local.php';
} else {
    $config = include $zendServiceCoreTests . DIRECTORY_SEPARATOR . 'config.local.php.dist';
}

if ($config['tests']['generate_report'] === true) {
    $codeCoverageFilter = PHP_CodeCoverage_Filter::getInstance();

    $lastArg = end($_SERVER['argv']);
    if (is_dir($zendServiceCoreTests . '/' . $lastArg)) {
        $codeCoverageFilter->addDirectoryToWhitelist($zendServiceCoreLibrary . '/' . $lastArg);
    } else if (is_file($zendServiceCoreTests . '/' . $lastArg)) {
        $codeCoverageFilter->addDirectoryToWhitelist(dirname($zendServiceCoreLibrary . '/' . $lastArg));
    } else {
        $codeCoverageFilter->addDirectoryToWhitelist($zendServiceCoreLibrary);
    }

    /*
     * Omit from code coverage reports the contents of the tests directory
     */
    $codeCoverageFilter->addDirectoryToBlacklist($zendServiceCoreTests, '');
    $codeCoverageFilter->addDirectoryToBlacklist(PEAR_INSTALL_DIR, '');
    $codeCoverageFilter->addDirectoryToBlacklist(PHP_LIBDIR, '');

    unset($codeCoverageFilter);
}


/**
 * Start output buffering, if enabled
 */
if ($config['tests']['enable_output_buffering']) {
    ob_start();
}

/*
 * Unset global variables that are no longer needed.
 */
unset($zendServiceRoot, $zendServiceCoreLibrary, $zendServiceCoreTests, $path);