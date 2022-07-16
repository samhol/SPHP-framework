<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualURLs;
use Sphp\Documentation\Linkers\PHP\URLGenerators\ApiGenUrls;
use Sphp\Documentation\Linkers\PHP\URLGenerators\DoctumUrlGenerator;
use Sphp\Documentation\Linkers\PHP\URLGenerators\PhpDocUrls;
use Sphp\Documentation\Linkers\PHP\URLGenerators\SamiUrls;
use Sphp\Stdlib\Arrays;
use Sphp\Reflection\{
  Utils\NamespaceUtils,
  ConstantReflector
};
use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Description of PHPApiUrlGeneratorCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPApiUrlGeneratorCollection implements PHPApiUrlGenerator, \IteratorAggregate, \Countable {

  /**
   * @var array<string, PHPApiUrlGenerator>
   */
  private array $map = [];
  private PHPManualURLs $native;

  /**
   * Constructor
   *
   * @param PHPManualURLs|null $native
   */
  public function __construct(?PHPManualURLs $native = null) {
    if ($native === null) {
      $native = new PHPManualURLs();
    }
    $this->native = $native;
    $this->map = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->native, $this->map);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->native = clone $this->native;
    $this->map = Arrays::copy($this->map);
  }

  /**
   * Maps an API URL generator to spesific namespace
   * 
   * @param  string $namespace the namespace name
   * @param  PHPApiUrlGenerator $linker
   * @return $this for a fluent interface
   */
  public function mapNamespace(string $namespace, PHPApiUrlGenerator $linker) {
    $trimmed = trim($namespace, '\\');
    $this->map[$trimmed] = $linker;
    krsort($this->map);
    return $this;
  }

  /**
   * 
   * @param  string $namespace
   * @param  string|null $root
   * @param  string|null $name
   * @return PhpDocUrls
   */
  public function mapPhpDoc(string $namespace, ?string $root = null, ?string $name = null): PhpDocUrls {
    $gen = new PhpDocUrls($root, $name);
    $this->mapNamespace($namespace, $gen);
    return $gen;
  }

  public function mapDoctum(string $namespace, ?string $root = null, ?string $name = null): DoctumUrlGenerator {
    $gen = new DoctumUrlGenerator($root, $name);
    $this->mapNamespace($namespace, $gen);
    return $gen;
  }

  public function mapApigen(string $namespace, ?string $root = null, ?string $name = null): ApiGenUrls {
    $gen = new ApiGenUrls($root, $name);
    $this->mapNamespace($namespace, $gen);
    return $gen;
  }

  public function mapSami(string $namespace, ?string $root = null, ?string $name = null): SamiUrls {
    $gen = new SamiUrls($root, $name);
    $this->mapNamespace($namespace, $gen);
    return $gen;
  }

  public function getPHPManual(): PHPManualURLs {
    return $this->native;
  }

  /**
   * Return the root namespaces documented
   * 
   * @return string[]
   */
  public function getNamespaces(): array {
    return array_keys($this->map);
  }

  /**
   * Checks if the namespace has a dedicatedURL generator
   * 
   * @param  string $namespace
   * @return bool
   */
  public function containsLinkerFor(string $namespace): bool {
    //echo "<pre><b>search for:</b> $namespace</pre>";
    $trimmed = trim($namespace, '\\');
    $contains = true;
    foreach ($this->getNamespaces() as $ns) {

      if (NamespaceUtils::isChildNamespaceOf($ns, $trimmed)) {
        // echo "\t yes";
        $contains = true;
        break;
      }
    }
    return $contains;
  }

  /**
   * 
   * @param  string $namespace
   * @return PHPApiUrlGenerator
   */
  public function getLinkerFor(string $namespace): PHPApiUrlGenerator {
    //echo "<pre><b>search for:</b> $namespace</pre>";
    $trimmed = trim($namespace, '\\');
    $linker = $this->native;
    foreach ($this->map as $ns => $linkerCandidate) {
      //echo "\ndoes $trimmed start with $ns?: ";
      if (NamespaceUtils::isChildNamespaceOf($ns, $trimmed)) {
        // echo "\t yes";
        $linker = $linkerCandidate;
        break;
      }
    }
    return $linker;
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    if ((new \ReflectionClass($class))->isInternal()) {
      $url = $this->native->getClassConstantUrl($class, $constant);
    } else {
      $url = $this->getLinkerFor($class)->getClassConstantUrl($class, $constant);
    }
    return $url;
  }

  public function getClassMethodUrl(string $class, string $method): string {
    if ((new \ReflectionMethod($class, $method))->isInternal()) {
      $url = $this->native->getClassMethodUrl($class, $method);
    } else {
      $url = $this->getLinkerFor($class)->getClassMethodUrl($class, $method);
    }
    return $url;
  }

  public function getClassPropertyUrl(string $class, string $property): string {
    return $this->getLinkerFor($class)->getClassPropertyUrl($class, $property);
  }

  public function getClassUrl(string $class): string {
    return $this->getLinkerFor($class)->getClassUrl($class);
  }

  public function getConstantUrl(string $constant): string {
    try {
      $ref = new ConstantReflector($constant);
    } catch (ReflectionException $ex) {
      throw new NonDocumentedFeatureException('Invalid constant name provided', 0, $ex);
    }
    if ($ref->isInternal()) {
      $url = $this->native->getConstantUrl($constant);
    } else {
      $url = $this->getLinkerFor($ref->getNamespaceName())->getConstantUrl($constant);
    }
    return $url;
  }

  public function getFunctionUrl(string $function): string {
    $sanitized = str_replace('()', '', $function);
    $ref = new \ReflectionFunction($sanitized);
    if ($ref->isInternal()) {
      $url = $this->getPHPManual()->getFunctionUrl($sanitized);
    } else {
      $url = $this->getLinkerFor($function)->getFunctionUrl($sanitized);
    }
    return $url;
  }

  public function getNamespaceUrl(string $namespace): string {
    return $this->getLinkerFor($namespace)->getNamespaceUrl($namespace);
  }

  public function getRootUrl(string $namespace = null): string {
    if ($namespace === null) {
      $root = $this->native->getRootUrl();
    } else {
      $root = $this->getLinkerFor($namespace)->getRootUrl();
    }
    return $root;
  }

  public function getApiname(string $namespace = null): string {
    if ($namespace === null) {
      $name = $this->native->getApiname();
    } else {
      $name = $this->getLinkerFor($namespace)->getApiname();
    }
    return $name;
  }

  public function count(): int {
    return count($this->map);
  }

  public function getIterator(): \Traversable {
    $it = new \ArrayIterator($this->map);
    return $it;
  }

}
