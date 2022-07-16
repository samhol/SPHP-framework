<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual\Books;

use IteratorAggregate;
use Traversable;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualUrlBuilder;

/**
 * Class Extensions
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class ExtensionDataManager implements IteratorAggregate {

  private static array $bookMap = [
      'apache' => 'Apache',
      'apc' => 'APC',
      'apcu' => 'APCu',
      'apd' => 'APD',
      'array' => 'Arrays',
      'bbcode' => 'BBCode',
      'bc' => 'BC Math',
      'bcompiler' => 'bcompiler',
      'blenc' => 'BLENC',
      'bzip2' => 'Bzip2',
      'cairo' => 'Cairo',
      'calendar' => 'Calendar',
      'chdb' => 'chdb',
      'classkit' => 'Classkit',
      'classobj' => 'Classes/Objects',
      'com' => 'COM',
      'crack' => 'Crack',
      'csprng' => 'CSPRNG',
      'ctype' => 'Ctype',
      'cubrid' => 'CUBRID',
      'curl' => 'cURL',
      'cyrus' => 'Cyrus',
      'datetime' => 'Date/Time',
      'dba' => 'DBA',
      'dbase' => 'dBase',
      'dbplus' => 'DB++',
      'dbx' => 'dbx',
      'dio' => 'Direct IO',
      'dir' => 'Directories',
      'dom' => 'DOM',
      'ds' => 'Data Structures',
      'eio' => 'Eio',
      'enchant' => 'Enchant',
      'errorfunc' => 'Error Handling',
      'ev' => 'Ev',
      'event' => 'Event',
      'exec' => 'Program execution',
      'exif' => 'Exif',
      'expect' => 'Expect',
      'fam' => 'FAM',
      'fann' => 'FANN',
      'fbsql' => 'FrontBase',
      'fdf' => 'FDF',
      'fileinfo' => 'Fileinfo',
      'filepro' => 'filePro',
      'filesystem' => 'Filesystem',
      'filter' => 'Filter',
      'fpm' => 'FastCGI Process Manager',
      'fribidi' => 'FriBiDi',
      'ftp' => 'FTP',
      'funchand' => 'Function Handling',
      'gearman' => 'Gearman',
      'gender' => 'Gender',
      'geoip' => 'GeoIP',
      'gettext' => 'Gettext',
      'gmagick' => 'Gmagick',
      'gmp' => 'GMP',
      'gnupg' => 'GnuPG',
      'gupnp' => 'Gupnp',
      'haru' => 'haru',
      'hash' => 'Hash',
      'hrtime' => 'HRTime',
      'htscanner' => 'htscanner',
      'hwapi' => 'Hyperwave API',
      'ibase' => 'Firebird/InterBase',
      'ibm-db2' => 'IBM DB2',
      'iconv' => 'iconv',
      'id3' => 'ID3',
      'ifx' => 'Informix',
      'iisfunc' => 'IIS',
      'image' => 'GD',
      'imagick' => 'ImageMagick',
      'imap' => 'IMAP',
      'inclued' => 'inclued',
      'info' => 'PHP Options/Info',
      'ingres' => 'Ingres',
      'inotify' => 'Inotify',
      'intl' => 'intl',
      'json' => 'JSON',
      'judy' => 'Judy',
      'kadm5' => 'KADM5',
      'ktaglib' => 'KTaglib',
      'lapack' => 'Lapack',
      'ldap' => 'LDAP',
      'libevent' => 'Libevent',
      'libxml' => 'libxml',
      'lua' => 'Lua',
      'lzf' => 'LZF',
      'mail' => 'Mail',
      'mailparse' => 'Mailparse',
      'math' => 'Math',
      'maxdb' => 'MaxDB',
      'mbstring' => 'Multibyte String',
      'mcrypt' => 'Mcrypt',
      'mcve' => 'MCVE',
      'memcache' => 'Memcache',
      'memcached' => 'Memcached',
      'memtrack' => 'Memtrack',
      'mhash' => 'Mhash',
      'mime-magic' => 'Mimetype',
      'ming' => 'Ming',
      'misc' => 'Misc.',
      'mnogosearch' => 'mnoGoSearch',
      'mongo' => 'Mongo',
      'bson' => 'MongoDB\BSON',
      'mongodb' => 'MongoDB\Driver',
      'mqseries' => 'mqseries',
      'msession' => 'Msession',
      'msql' => 'mSQL',
      'mssql' => 'Mssql',
      'mysql' => 'MySQL (Original)',
      'mysqli' => 'MySQLi',
      'mysqlnd' => 'Mysqlnd',
      'mysqlnd-memcache' => 'mysqlnd_memcache',
      'mysqlnd-ms' => 'mysqlnd_ms',
      'mysqlnd-mux' => 'mysqlnd_mux',
      'mysqlnd-qc' => 'mysqlnd_qc',
      'mysqlnd-uh' => 'mysqlnd_uh',
      'ncurses' => 'Ncurses',
      'net-gopher' => 'Gopher',
      'network' => 'Network',
      'newt' => 'Newt',
      'nis' => 'YP/NIS',
      'nsapi' => 'NSAPI',
      'oauth' => 'OAuth',
      'oci8' => 'OCI8',
      'oggvorbis' => 'oggvorbis',
      'opcache' => 'OPcache',
      'openal' => 'OpenAL',
      'openssl' => 'OpenSSL',
      'outcontrol' => 'Output Control',
      'paradox' => 'Paradox',
      'parle' => 'Parle',
      'parsekit' => 'Parsekit',
      'password' => 'Password Hashing',
      'pcntl' => 'PCNTL',
      'pcre' => 'PCRE',
      'pdf' => 'PDF',
      'pdo' => 'PDO',
      'pgsql' => 'PostgreSQL',
      'phar' => 'Phar',
      'phdfs' => 'Phdfs',
      'posix' => 'POSIX',
      'proctitle' => 'Proctitle',
      'ps' => 'PS',
      'pspell' => 'Pspell',
      'pthreads' => 'pthreads',
      'quickhash' => 'Quickhash',
      'radius' => 'Radius',
      'rar' => 'Rar',
      'readline' => 'Readline',
      'recode' => 'Recode',
      'reflection' => 'Reflection',
      'regex' => 'POSIX Regex',
      'rpmreader' => 'RPM Reader',
      'rrd' => 'RRD',
      'runkit' => 'runkit',
      'sam' => 'SAM',
      'sca' => 'SCA',
      'scoutapm' => 'ScoutAPM',
      'scream' => 'scream',
      'sdo' => 'SDO',
      'sdo-das-xml' => 'SDO DAS XML',
      'sdodasrel' => 'SDO-DAS-Relational',
      'seaslog' => 'Seaslog',
      'sem' => 'Semaphore',
      'session' => 'Sessions',
      'session-pgsql' => 'Session PgSQL',
      'shmop' => 'Shared Memory',
      'simplexml' => 'SimpleXML',
      'snmp' => 'SNMP',
      'soap' => 'SOAP',
      'sockets' => 'Sockets',
      'sodium' => 'Sodium',
      'solr' => 'Solr',
      'sphinx' => 'Sphinx',
      'spl' => 'SPL',
      'spl-types' => 'SPL Types',
      'sqlite' => 'SQLite',
      'sqlite3' => 'SQLite3',
      'sqlsrv' => 'SQLSRV',
      'ssdeep' => 'ssdeep',
      'ssh2' => 'SSH2',
      'stats' => 'Statistics',
      'stomp' => 'Stomp',
      'stream' => 'Streams',
      'strings' => 'Strings',
      'svm' => 'SVM',
      'svn' => 'SVN',
      'swish' => 'Swish',
      'swoole' => 'Swoole',
      'sybase' => 'Sybase',
      'sync' => 'Sync',
      'taint' => 'Taint',
      'tcpwrap' => 'TCP',
      'tidy' => 'Tidy',
      'tokenizer' => 'Tokenizer',
      'tokyo-tyrant' => 'tokyo_tyrant',
      'trader' => 'Trader',
      'ui' => 'UI',
      'uodbc' => 'ODBC',
      'uopz' => 'uopz',
      'url' => 'URLs',
      'v8js' => 'V8js',
      'var' => 'Variable handling',
      'varnish' => 'Varnish',
      'vpopmail' => 'vpopmail',
      'wddx' => 'WDDX',
      'weakref' => 'Weakref',
      'win32ps' => 'win32ps',
      'apache' => 'win32service',
      'wincache' => 'WinCache',
      'wkhtmltox' => 'wkhtmltox',
      'xattr' => 'xattr',
      'xdiff' => 'xdiff',
      'xhprof' => 'Xhprof',
      'xml' => 'XML Parser',
      'xmldiff' => 'XMLDiff',
      'xmlreader' => 'XMLReader',
      'xmlrpc' => 'XML-RPC',
      'xmlwriter' => 'XMLWriter',
      'xsl' => 'XSL',
      'yaconf' => 'Yaconf',
      'yaf' => 'Yaf',
      'yaml' => 'Yaml',
      'yar' => 'Yar',
      'yaz' => 'YAZ',
      'zip' => 'Zip',
      'zlib' => 'Zlib',
      'zmq' => 'ZMQ messaging',
      'zookeeper' => 'ZooKeeper'
  ];
  private static array $refMap = [
      'pdo-4d' => '4D (PDO)',
      'pdo-cubrid' => 'CUBRID (PDO)',
      'pdo-dblib' => 'MS SQL Server (PDO)',
      'pdo-firebird' => 'Firebird (PDO)',
      'pdo-ibm' => 'IBM (PDO)',
      'pdo-informix' => 'Informix (PDO)',
      'pdo-mysql' => 'MySQL (PDO)',
      'pdo-oci' => 'Oracle (PDO)',
      'pdo-odbc' => 'ODBC and DB2 (PDO)',
      'pdo-pgsql' => 'PostgreSQL (PDO)',
      'pdo-sqlite' => 'SQLite (PDO)',
      'pdo-sqlsrv' => 'MS SQL Server (PDO)',
  ];

  /**
   * @var Reference[] 
   */
  private array $references;

  /**
   * @var PHPManualUrlBuilder 
   */
  private PHPManualUrlBuilder $urlBuilder;

  /**
   * Constructor
   * 
   * @param PHPManualUrlBuilder|null $urlBuilder
   */
  public function __construct(?PHPManualUrlBuilder $urlBuilder = null) {
    if ($urlBuilder === null) {
      $urlBuilder = new PHPManualUrlBuilder();
    }
    $this->urlBuilder = $urlBuilder;
    $this->references = [];
  }

  /**
   * Destroys the instance
   */
  public function __destruct() {
    unset($this->urlBuilder, $this->references);
  }

  /**
   * Checks if the paramater is a reference or a book name
   * 
   * @param  string $name
   * @return bool true if the paramater is a reference or a book name, false otherwise
   */
  public function isReference(string $name): bool {
    return array_key_exists($name, self::$refMap) || $this->isBook($name);
  }

  /**
   * Checks if the paramater is a book name
   * 
   * @param  string $name
   * @return bool true if the paramater is a book name, false otherwise
   */
  public function isBook(string $name): bool {
    return array_key_exists($name, self::$bookMap);
  }

  /**
   * 
   * 
   * @param  string $name
   * @param  PHPManualUrlBuilder|null $urlBuilder
   * @return Reference|Book|null
   */
  public function getReference(string $name, ?PHPManualUrlBuilder $urlBuilder = null): ?Reference {
    $result = null;
    if ($this->isBook($name)) {
      $result = new Book($name, self::$bookMap[$name], $urlBuilder);
    } else if ($this->isReference($name)) {
      $result = new Reference($name, self::$refMap[$name], $urlBuilder);
    }
    return $result;
  }

  /**
   * 
   * @return Traversable<string, Book>
   */
  public function getIterator(): Traversable {
    foreach (self::$bookMap as $name => $description) {
      yield $name => new Book($name, $description, $this->urlBuilder);
    }
    foreach (self::$refMap as $name => $description) {
      yield $name => new Reference($name, $description, $this->urlBuilder);
    }
  }

  private static ?ExtensionDataManager $instance = null;

  /**
   * Returns the factory instance
   * 
   * @return ExtensionDataManager factory instance
   */
  public static function instance(): ExtensionDataManager {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

}
