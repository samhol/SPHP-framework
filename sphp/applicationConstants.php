<?php

namespace Sphp;

use Sphp\Config\Config;


/**
 * SPHP frameworks folder's root
 */
const SPHP_DIR = __DIR__;

//Configuration::useDomain("manual")->set("SPHP_DIR", __DIR__);

$sphp = [
    'SPH_DIR' => __DIR__
];
//Configuration::setSphpRoot(__DIR__, Configuration::httpHost());
$sphpConf = Config::instance('sphp');
$sphpConf->sphp = $sphp;

//define('Sphp\PHP_PACKAGES', SPH_DIR . "/php/packages");
//define('Sphp\SPH_PACKAGE', PHP_PACKAGES . "/php/sph");
//define('Sphp\LOCALE_PATH', __DIR__ . "/locale");

const DEFAULT_DOMAIN = "Sphp.Defaults";

/**
 * Http root folder path
 */
const HTTP_ROOT = 'http://playground.samiholck.com/';

namespace Sphp\js;

/**
 * path to the error log file
 */
define('Sphp\ERROR_LOG_PATH', \Sphp\SPHP_DIR . "/errors.log");


define('Sphp\Images\SCALER', \Sphp\HTTP_ROOT . "sphp/image/thumb.php");

######################################################################
# NOTE! Do not modify these unless you truly know what you are doing #
######################################################################
/**
 * PDO database constants
 */

namespace Sphp\Db;

const PDO_DNS = 'mysql:host=192.168.10.208;port=3306;dbname=sphp;charset=utf8';
const PDO_SU_USERNAME = 'sphp_su';
const PDO_SU_PASSWORD = 'o5Qen58&';
const PDO_USERNAME = 'sphp_framework';
const PDO_PASSWORD = 'Vxr79s?8';

/*$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'sphp_framework',
    'password' => 'Vxr79s?8',
    'host' => '192.168.10.208;port=3306',
    'charset' => 'utf8',
    'dbname' => 'sphp',
    'driverOptions' => [1002 => 'SET NAMES utf8']
);*/

namespace Sphp\Images;

define('Sphp\Images\CACHE', \Sphp\SPHP_DIR . "/image/cache");
define('Sphp\Images\CACHE_HTTP', \Sphp\HTTP_ROOT . "sphp/image/cache");
//define('Sphp\Images\IMAGE_APP', \Sphp\HTTP_ROOT . "sphp/image/image.php");
//const RESIZE = 0b1;			//1
//const SCALE = 0b10;			//2
//const SCALE_TO_FIT = 0b100;	//4

