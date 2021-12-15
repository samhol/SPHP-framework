<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Stdlib\Strings;
use Sphp\Reflection\ConstantReflector;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\ExtensionDataManager;

/**
 * Class ConstantPathBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
final class ConstantPathBuilder {

  private const CONSTANT_PATH = '%s.constants.php#constant.%s';

  private static array $extMap = [
      // 'date' => 'datetime',
      'zend opcache' => 'opcache',
      'gd' => 'image',
      'Core' => 'reserved'
  ];
  private static array $standardExtRules = [
      'info' => '/^((CREDITS)|(INFO)|(ASSERT)|(PHP_WINDOWS)|(INI))_/',
      'session' => '/^(SID)$|(PHP_SESSION_)/',
      'stream' => '/^((STREAM)|(PSFS))_/',
      'network' => '/^((LOG)|(DNS))_/',
      'filesystem' => '/^((FILE)|(LOCK)|(SEEK)|(FNM)|(INI_SCANNER)|(PATHINFO)|(GLOB))_/',
      'string' => '/^((CRYPT)|(HTML)|(ENT)|(LC)|(STR)|(CHAR))_/',
      'array' => '/^((ARRAY)|(CASE)|(SORT)|(COUNT)|(EXTR))_/',
      'url' => '/^((PHP_(URL|QUERY)))_/',
      'password' => '/^PASSWORD_/',
      'image' => '/^IMAGETYPE_/',
      'math' => '/^(((M)|(PHP_ROUND_HALF))_)|(NAN$)|(INF$)/',
      'dir' => '/^(SCANDIR_SORT_)|(PATH_SEPARATOR)|(DIRECTORY_SEPARATOR)/',
      'misc' => '/^((CONNECTION)_)/',
      'errorfunc' => '/^(E_)/',
  ];

  private function __construct() {
    
  }

  /**
   * 
   * @param  ConstantReflector $c
   * @return string
   * @throws NonDocumentedFeatureException
   */
  private function getReferenceName(ConstantReflector $c): string {
    if ($c->isDefined()) {
      $extName = $this->parseDefined($c);
    } else {
      $extName = $this->parseUndefined($c);
    }
    $extName = strtolower((string) $extName);
    if ($extName === 'date') {
      $url = $this->manageDateTimeExt($c->getShortName());
    } else if ($extName === 'reserved') {
      $url = $this->manageCoreExtension($c->getShortName());
    } else if ($extName === 'tokenizer') {
      $url = 'tokens.php';
    } else {
      $constName = str_replace('_', '-', strtolower($c->getShortName()));
      if ($c->inNamespace()) {
        $url = sprintf('%1$s.constants.php#%1$s.constant.%2$s', $extName, $constName);
      } else {
        $url = sprintf(self::CONSTANT_PATH, $extName, $constName);
      }
    }
    return $url;
  }

  private function parseDefined(ConstantReflector $constant): string {
    if ($constant->isUserDefined()) {
      throw new NonDocumentedFeatureException("PHP constant {$constant->getName()} is defined but not internal");
    }
    $extName = $constant->getExtensionName();
    //echo "\n defined constant: " . $constant->getName() . "\n\t extension: $extName";
    if (array_key_exists($extName, self::$extMap)) {
      $extName = self::$extMap[$extName];
    } else if ($extName === 'standard') {
      //echo "\n$extName, $constant";
      $extName = $this->splitStandardExtension($constant->getName());
    }
    return $extName;
  }

  private function parseUndefined(ConstantReflector $constant): ?string {
    $extName = null;
    if ($constant->inNamespace()) {
      $namespace = $constant->getNamespaceName();
      $book = ExtensionDataManager::instance()->getReference(strtolower($namespace));
      //echo "\nns:$namespace, book: {$book->getName()} \n";
      if ($book !== null) {
        $extName = $book->getName();
        // echo "\nns:$namespace, book: {$book->getName()}\n";
      }
    } else {
      $extName = $this->splitStandardExtension($constant->getName());
    }
    //$extName = $this->splitStandardExtension($constant->getName());
    //echo "\n undefined constant: " . $constant->getName() . "\n\t extension: $extName";
    return $extName;
  }

  private function splitStandardExtension(string $constant): string {
    $output = 'reserved';
    foreach (self::$standardExtRules as $bookName => $rule) {
      if (Strings::match($constant, $rule)) {
        $output = $bookName;
        break;
      }
    }
    return $output;
  }

  private function manageDateTimeExt(string $constant): string {
    if (Strings::match($constant, '/^(SUNFUNCS_RET_(TIMESTAMP|STRING|DOUBLE))$/')) {
      $constName = str_replace('_', '-', strtolower($constant));
      $url = sprintf(self::CONSTANT_PATH, 'datetime', $constName);
    } else {
      $constName = str_replace('date_', '', strtolower($constant));
      $url = sprintf('class.datetimeinterface.php#datetime.constants.%s', $constName);
    }
    return $url;
  }

  private function manageCoreExtension(string $constant): string {
    $extName = 'reserved';
    $format = self::CONSTANT_PATH;
    //echo "\n$constant";
    if (Strings::match($constant, '/^(E_)/')) {
      $format = 'errorfunc.constants.php#errorfunc.constants.errorlevels.%2$s';
    }
    $constName = str_replace('_', '-', strtolower($constant));
    $url = sprintf($format, $extName, $constName);
    return $url;
  }

  /**
   * Returns the path to the constant documentation
   * 
   * @param string $constant the name of the constant
   * @return string the path to the constant documentation
   */
  public function __invoke(string $constant): string {
    $ref = new ConstantReflector($constant);
    if ($ref->isMagicConstant($constant)) {
      $constant = str_replace(['__', '_'], ['', '-'], strtolower($constant));
      $url = sprintf("language.constants.magic.php#constant.$constant");
    } else {
      $url = $this->getReferenceName($ref);
    }
    return $url;
  }

  private static ?self $instance = null;

  /**
   * Returns the factory instance
   * 
   * @return ConstantPathBuilder factory instance
   */
  public static function instance(): ConstantPathBuilder {
    if (self::$instance === null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

}
