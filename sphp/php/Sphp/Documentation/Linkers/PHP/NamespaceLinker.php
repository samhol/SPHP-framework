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
use Sphp\Html\Navigation\A;
use Sphp\Html\Span;
use Sphp\Html\Navigation\Nav;
use Sphp\Reflection\Utils\NamespaceUtils;
use IteratorAggregate;
use Sphp\Html\ContentIterator;
use Sphp\Html\PlainContainer;
use Sphp\Documentation\Linkers\Exceptions\InvalidArgumentException;

/**
 * Implements a URL string generator pointing to an online PHP API about an item in namespace
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NamespaceLinker extends AbstractItemLinker implements IteratorAggregate {

  private string $namespaceName;
  private NamespaceApiUrlGenerator $urlGen;

  /**
   * Constructor
   * 
   * @param  string $namespace
   * @param  NamespaceApiUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   * @throws InvalidArgumentException if namespace is not a valid PHP namespace
   */
  public function __construct(string $namespace, NamespaceApiUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $trimmed = trim($namespace, '\\');
    if (!NamespaceUtils::isValidNamespace($trimmed)) {
      throw new InvalidArgumentException('Given namespace name (' . $trimmed . ') is not a valid PHP namespace');
    }
    if ($namespace === '') {
      throw new InvalidArgumentException('Empty namespacename given');
    }
    $this->namespaceName = $trimmed;

    $this->urlGen = $urlGen;
    parent::__construct($hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('php-api', 'namespace');
    // $params = new \Sphp\Html\Attributes\JsonAttribute('data-sphp-apilink-options');
    // $params->setValue(['php' => $this->getNamespaceName()]);
    // $this->getHyperlinkFactory()->getDefaultAttributes()->setInstance($params);
  }

  public function __destruct() {
    unset($this->urlGen);
    parent::__destruct();
  }

  public function getNamespaceName(): string {
    return $this->namespaceName;
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @return A hyperlink object pointing to the documentation
   */
  public function toShortlink(): A {
    $nsArr = explode('\\', $this->getNamespaceName());
    $name = array_pop($nsArr);
    return $this->toHyperlink($name);
  }

  public function getDefaultContent(): string {
    return $this->getNamespaceName();
  }

  public function getDefaultTitle(): string {
    return 'Documentation of the ' . $this->getNamespaceName() . ' namespace';
  }

  /**
   * Returns the trail of nested namespace hyperlinkobjects
   * 
   * @return array<int, NamespaceLinker> containing showing the trail of nested namespaces
   */
  public function toArray(): array {
    $items = [];
    foreach (NamespaceUtils::explodeNamespaceArray($this->namespaceName) as $name) {
      $items[] = new NamespaceLinker($name, $this->urlGen, $this->cloneHyperlinkFactory());
    }
    return $items;
  }

  /**
   * Returns the trail of nested namespace hyperlinkobjects
   * 
   * @return ContentIterator<int, NamespaceLinker> containing showing the trail of nested namespaces
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->toArray());
  }

  /**
   * Creates a new inline navigation component showing the trail of nested namespaces
   * 
   * @return Span new instance
   */
  public function toInlineNavBar(): Span {
    $span = new Span();
    $span->addCssClass('breadcrumbs api php');
    $container = new PlainContainer();
    $trail = $this->toArray();
    $count = count($trail);
    foreach ($trail as $index => $item) {
      $container->append($item->toShortlink());
      if ($index < $count - 1) {
        $container->appendSpan('&#92;')->addCssClass('slash');
      }
    }
    $span->append($container);
    return $span;
  }

  /**
   * Creates a new navigation component showing the trail of nested namespaces
   * 
   * @return Nav new instance
   */
  public function toNavBar(): Nav {
    $nav = new Nav();
    $nav->addCssClass('breadcrumbs api php');
    $nav->append('<span class="type-text">Namespace</span>');
    $trail = $this->toArray();
    $count = count($trail);
    foreach ($trail as $index => $link) {
      $nav->append($link->toShortlink());
      if ($index < $count - 1) {
        $nav->append(' <span class="slash">&#92;</span> ');
      }
    }
    return $nav;
  }

  public function getUrl(): string {
    return $this->urlGen->getNamespaceUrl($this->getNamespaceName());
  }

}
