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
use Sphp\Reflection\ConstantReflector;

/**
 * Implements an API documentation link factory for a PHP constant
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ConstantLinker extends AbstractItemLinker {

  private ConstantReflector $ref;
  private ConstantApiUrlGenerator $urlGen;

  /**
   * Constructor
   * 
   * @param string $constantName
   * @param ConstantApiUrlGenerator $urlGen
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(string $constantName, ConstantApiUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->ref = new ConstantReflector($constantName);
    $this->urlGen = $urlGen;
    parent::__construct($hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('constant');
    if ($this->ref->isInternal()) {
      $this->getHyperlinkFactory()->useCssClass('php');
    }
  }

  public function __destruct() {
    unset($this->ref, $this->urlGen);
    parent::__destruct();
  }

  public function getConstantName(): string {
    return $this->ref->getName();
  }

  public function getDefaultContent(): string {
    return $this->getConstantName();
  }

  public function getDefaultTitle(): string {
    return 'Documentation of the ' . $this->getConstantName() . ' constant';
  }

  public function namespaceLink(): ?NamespaceLinker {
    if ($this->ref->inNamespace()) {
      $linker = new NamespaceLinker($this->ref->getNamespaceName(), $this->urlGen, $this->cloneHyperlinkFactory());
    } else {
      $linker = null;
    }
    return $linker;
  }

  public function getUrl(): string {
    return $this->urlGen->getConstantUrl($this->getConstantName());
  }

}
