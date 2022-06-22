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

use Sphp\Documentation\Linkers\AbstractDocumentationLinker;
use Sphp\Documentation\Linkers\PHP\PHPManual\ExtensionLinkerInterface;
use Sphp\Documentation\Linkers\PHP\PHPManual\BookLinker;
use Sphp\Documentation\Linkers\PHP\PHPManual\LanguageReferenceLinker;
use Sphp\Stdlib\Strings;
use Sphp\Documentation\Linkers\ItemLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Reflection\Utils\PHPWords;
use Sphp\Documentation\Linkers\ApiUrlGenerator;

/**
 * Hyperlink generator pointing to an online PHP API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://www.php.net/urlhowto.php PHP manual Navigation tips&tricks
 * @filesource
 */
class PhpApiLinker extends AbstractDocumentationLinker implements PhpApiLinkerInterface {

  private PHPApiUrlGeneratorCollection $urlGen;

  /**
   * Constructor
   *
   * @param PHPApiUrlGeneratorCollection|null $urlGen
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(?PHPApiUrlGeneratorCollection $urlGen = null, ?HyperlinkFactory $hyperlinkFactory = null) {
    if ($urlGen === null) {
      $urlGen = new PHPApiUrlGeneratorCollection();
    }
    $this->urlGen = $urlGen;
    parent::__construct($this->urlGen, $hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('php-api');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->urlGen);
  }

  /**
   * Returns linker properties or hyperlinks
   * 
   * @param  string $name
   * @return ItemLinker
   * @throws NonDocumentedFeatureException
   */
  public function __invoke(string $name): ItemLinker {
    return $this->build($name);
  }

  public function urls(): ApiUrlGenerator {
    return $this->urlGen;
  }

  /**
   * Returns linker properties or hyperlinks
   * 
   * @param  string $name
   * @return ItemLinker
   * @throws NonDocumentedFeatureException
   */
  public function build(string $name): ItemLinker {
    try {
      if (str_contains($name, '::')) {
        $parts = explode('::', $name);
        list($class, $member) = $parts;
        $component = $this->classLinker($class)($member);
      } else if (str_ends_with($name, '()') || function_exists($name)) {
        $component = $this->functionLink($name);
      } else if (defined($name)) {
        $component = $this->constantLink($name);
      } else if (class_exists($name) || interface_exists($name) || trait_exists($name)) {
        $component = $this->classLinker($name);
      } else if (PHPWords::fullCollection()->containsWord($name)) {
        $component = $this->languageReference($name);
      } else {
        $component = $this->namespaceLink($name);
      }
      return $component;
    } catch (\Exception $ex) {
      throw new NonDocumentedFeatureException('Invalid type name given', 0, $ex);
    }
  }

  public function namespaceLink(string $namespace): NamespaceLinker {
    return new NamespaceLinker($namespace, $this->urls(), $this->cloneHyperlinkFactory());
  }

  public function extensionLink(string $extName): ExtensionLinkerInterface {
    return BookLinker::create($extName, $this->cloneHyperlinkFactory());
  }

  public function languageReference(string $controlName): LanguageReferenceLinker {
    return new LanguageReferenceLinker($controlName, $this->urlGen->getPHPManual(), $this->cloneHyperlinkFactory());
  }

  public function classLinker(string $class): ClassLinker {
    return ClassLinker::create($class, $this->urls(), $this->cloneHyperlinkFactory());
  }

  public function functionLink(string $function): FunctionLinker {
    return new FunctionLinker($function, $this->urls(), $this->cloneHyperlinkFactory());
  }

  public function constantLink(string $constant): ConstantLinker {
    return new ConstantLinker($constant, $this->urls(), $this->cloneHyperlinkFactory());
  }

}
