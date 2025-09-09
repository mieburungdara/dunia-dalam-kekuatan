<?php

define('SITE_TITLE', 'Dunia dalam Kekuatan');

/**
 * CodeIgniter Bootstrap
 *
 * @package   CodeIgniter
 * @license   https://opensource.org/licenses/MIT  MIT License
 */

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 */
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 */
switch (ENVIRONMENT)
{
    case 'development':
        error_reporting(E_ALL & ~E_DEPRECATED);
        ini_set('display_errors', 1);
        break;

    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>='))
        {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        }
        else
        {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

/*
 *---------------------------------------------------------------
 * PATHS CONFIGURATION
 *---------------------------------------------------------------
 */
$system_path       = 'system';
$application_folder = 'application';
$view_folder       = '';

/*
 *---------------------------------------------------------------
 * PATH NORMALIZER HELPER
 *---------------------------------------------------------------
 */
function normalize_path($path, $add_trailing_slash = true)
{
    $path = strtr(
        rtrim($path, '/\\'),
        '/\\',
        DIRECTORY_SEPARATOR
    );
    return $add_trailing_slash ? $path . DIRECTORY_SEPARATOR : $path;
}

/*
 *---------------------------------------------------------------
 * RESOLVE SYSTEM PATH
 *---------------------------------------------------------------
 */
if (defined('STDIN'))
{
    chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE)
{
    $system_path = $_temp . DIRECTORY_SEPARATOR;
}
else
{
    $system_path = normalize_path($system_path);
}

if ( ! is_dir($system_path))
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your system folder path does not appear to be set correctly: '.pathinfo(__FILE__, PATHINFO_BASENAME);
    exit(3); // EXIT_CONFIG
}

/*
 *---------------------------------------------------------------
 * MAIN PATH CONSTANTS
 *---------------------------------------------------------------
 */
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', $system_path);
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('SYSDIR', basename(BASEPATH));

/*
 *---------------------------------------------------------------
 * APPLICATION FOLDER
 *---------------------------------------------------------------
 */
if (is_dir($application_folder))
{
    if (($_temp = realpath($application_folder)) !== FALSE)
    {
        $application_folder = $_temp;
    }
    else
    {
        $application_folder = normalize_path($application_folder, false);
    }
}
elseif (is_dir(BASEPATH . $application_folder . DIRECTORY_SEPARATOR))
{
    $application_folder = BASEPATH . normalize_path($application_folder, false);
}
else
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your application folder path does not appear to be set correctly: '.SELF;
    exit(3); // EXIT_CONFIG
}

define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * VIEW FOLDER
 *---------------------------------------------------------------
 */
if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
{
    $view_folder = APPPATH.'views';
}
elseif (is_dir($view_folder))
{
    if (($_temp = realpath($view_folder)) !== FALSE)
    {
        $view_folder = $_temp;
    }
    else
    {
        $view_folder = normalize_path($view_folder, false);
    }
}
elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
{
    $view_folder = APPPATH . normalize_path($view_folder, false);
}
else
{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your view folder path does not appear to be set correctly: '.SELF;
    exit(3); // EXIT_CONFIG
}

define('VIEWPATH', $view_folder . DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 *---------------------------------------------------------------
 */
require_once BASEPATH.'core/CodeIgniter.php';
