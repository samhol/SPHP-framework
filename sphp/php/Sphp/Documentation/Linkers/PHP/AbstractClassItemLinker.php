<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

use Sphp\Documentation\Linkers\AbstractItemLinker;
use IteratorAggregate;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Reflection\ClassMemberReflector;
use Sphp\Html\Navigation\A;
use Sphp\Html\Navigation\Nav;
use Sphp\Html\ContentIterator;
use Sphp\Html\PlainContainer;
use Sphp\Html\Content;
use Sphp\Html\Text\Span;

/**
 * Implements a link factory pointing to an external API documentation about a PHP class, interface or trait method
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractClassItemLinker extends AbstractItemLinker implements IteratorAggregate, NavbarItem {

  private ClassMemberReflector $ref;
  private ClassUrlGenerator $urlGen;

  /**
   * Constructor
   * 
   * @param  ClassMemberReflector $ref
   * @param  ClassUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(ClassMemberReflector $ref, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->ref = $ref;
    $this->urlGen = $urlGen;
    parent::__construct($hyperlinkFactory);
    if ($this->ref->isInternal()) {
      $this->getHyperlinkFactory()->useCssClass('php-manual');
    } else {
      $this->getHyperlinkFactory()->useCssClass('php-api');
    }
  }

  public function __destruct() {
    unset($this->ref, $this->urlGen);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->urlGen = clone $this->urlGen;
  }

  /**
   * Returns a hyperlink object pointing to the API documentation of the class member
   * 
   * @param  string|null $linkText
   * @return A
   */
  public function __invoke(?string $linkText = null): A {
    return $this->toHyperlink($linkText);
  }

  public function getNamespaceName(): string {
    return $this->ref->getCurrentClass()->getNamespaceName();
  }

  public function getClassName(): string {
    return $this->ref->getCurrentClass()->getName();
  }

  public function getShortClassName(): string {
    return $this->ref->getCurrentClass()->getShortName();
  }

  abstract public function toShortlink(): A;

  public function toSplitLink(): Content {
    $container = new PlainContainer();
    $class = new ClassLinker($this->ref->getCurrentClass(), $this->urlGen);
    $container->append($class->toHyperlink());
    $container->appendSpan('::')->addCssClass('paamayim-nekudotayim');
    $container->append($this->toShortlink());
    return $container;
  }

  public function namespaceLink(): ?NamespaceLinker {
    $linker = null;
    if ($this->inNamespace()) {
      $linker = new NamespaceLinker($this->ref->getCurrentClass()->getNamespaceName(), $this->urlGen, $this->cloneHyperlinkFactory());
    }
    return $linker;
  }

  /**
   * Checks if member is in namespace
   * 
   * @return bool true on success or false on failure
   */
  public function inNamespace(): bool {
    return $this->ref->getCurrentClass()->inNamespace();
  }

  /**
   * Creates a new BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return Span new instance
   */
  public function toInlineNavBar(): Span {
    $nav = new Span();
    $nav->addCssClass('php-api');
    if ($this->inNamespace()) {
      foreach ($this->namespaceLink() as $ns) {
        $nav->append($ns->toShortlink());
        $nav->append(' <span class="slash">&#92;</span> ');
      }
    }
    $nav->append($this->toSplitlink());
    return $nav;
  }

  abstract public function getNavBarTitle(): string;

  /**
   * Creates a new BreadCrumbs navigation component
   * 
   * BreadCrumbs component shows the class member and the trail of nested
   * namespaces leading to it
   * 
   * @return Nav new instance
   */
  public function toNavBar(): Nav {
    $nav = new Nav();
    $nav->addCssClass('breadcrumbs api php');
    $nav->append('<span class="type-text">' . $this->getNavBarTitle() . '</span>');
    if ($this->inNamespace()) {
      foreach ($this->namespaceLink() as $ns) {
        $nav->append($ns->toShortlink());
        $nav->append('<span class="slash">&#92;</span>');
      }
    }
    $nav->append($this->toSplitlink());
    return $nav;
  }

  /**
   * Returns the trail of linkers 
   * 
   * @return ItemLinker[] breadcrumb links showing the trail of nested namespaces
   */
  public function toArray(): array {
    if ($this->ref->getCurrentClass()->inNamespace()) {
      $trail = $this->namespaceLink()->toArray();
    } else {
      $trail = [];
    }
    $trail[] = $this;
    return $trail;
  }

  /**
   * Returns the linker chain iterator
   * 
   * @return ContentIterator<int, ItemLinker>
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->toArray());
  }

}
