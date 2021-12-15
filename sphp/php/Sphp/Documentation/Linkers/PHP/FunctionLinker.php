<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

use Sphp\Documentation\Linkers\AbstractItemLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use ReflectionFunction;

/**
 * Description of FunctionLinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FunctionLinker extends AbstractItemLinker {

  private ReflectionFunction $ref;
  private FunctionApiUrlGenerator $urlGen;

  /**
   * Constructor
   * 
   * @param string $function
   * @param FunctionApiUrlGenerator $urlGen
   * @param HyperlinkFactory|null $hyperlinkTemplate
   */
  public function __construct(string $function, FunctionApiUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkTemplate = null) {
    $sanitized = str_replace('()', '', $function);
    $this->ref = new ReflectionFunction($sanitized);
    $this->urlGen = $urlGen;
    parent::__construct($hyperlinkTemplate);
    $this->getHyperlinkFactory()->useCssClass('function', 'php-api');
    if ($this->ref->isInternal()) {
      $this->getHyperlinkFactory()->useCssClass('php-manual');
    }
  }

  public function __destruct() {
    unset($this->ref, $this->urlGen);
    parent::__destruct();
  }

  public function getFunctionName(): string {
    return $this->ref->getName();
  }

  public function namespaceLink(): ?NamespaceLinker {
    $linker = null;
    if ($this->ref->inNamespace()) {
      $linker = new NamespaceLinker($this->ref->getNamespaceName(), $this->urlGen, $this->cloneHyperlinkFactory());
    }
    return $linker;
  }

  public function getDefaultContent(): string {
    return "{$this->ref->getName()}()";
  }

  public function getDefaultTitle(): string {
    return "Documentation of {$this->ref->getName()}() function";
  }

  public function getUrl(): string {
    return $this->urlGen->getFunctionUrl($this->ref->getName());
  }

}
