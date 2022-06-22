<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

use Sphp\Documentation\Linkers\AbstractItemLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Reflection\ClassReflector;
use Sphp\Html\Navigation\A;
use Sphp\Html\Text\Span;
use Sphp\Html\Navigation\Nav;
use Sphp\Stdlib\Strings;
use Sphp\Reflection\Exceptions\ReflectionException;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Documentation\Linkers\ItemLinker;

/**
 * Documentation link builder for a PHP class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
final class ClassLinker extends AbstractItemLinker {

  protected ClassReflector $ref;
  private ClassUrlGenerator $urlGen;

  /**
   * Constructor
   *
   * @param ClassReflector $ref class reflector
   * @param ClassUrlGenerator $urlGen
   * @param HyperlinkFactory|null $hyperlinkGenerator
   */
  public function __construct(ClassReflector $ref, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkGenerator = null) {
    $this->ref = $ref;
    $this->urlGen = $urlGen;
    parent::__construct($hyperlinkGenerator);
    $this->getHyperlinkFactory()
            ->useCssClass($this->ref->getModifierNames(), 'php-api');
  }

  public function __destruct() {
    unset($this->urlGen, $this->ref);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->urlGen = clone $this->urlGen;
  }

  /**
   * Returns a hyperlink object pointing to the API documentation of the given property or method
   * 
   * @param  string $member
   * @return ItemLinker
   * @throws NonDocumentedFeatureException if the class member not found in class
   */
  public function __invoke(string $member): ?ItemLinker {
    try {
      $link = null;
      if (str_ends_with($member, '()')) {
        $link = $this->methodLink($member);
      } else if (str_starts_with($member, '$')) {
        $link = $this->propertyLink(Strings::replace($member, '$', ''));
      } else if ($this->ref->hasConstant($member)) {
        $link = $this->constantLink($member);
      } else if ($this->ref->hasMethod($member)) {
        $link = $this->methodLink($member);
      } else if ($this->ref->hasProperty($member)) {
        $link = $this->propertyLink($member);
      }
    } catch (\Exception $ex) {
      throw new NonDocumentedFeatureException("Class member not found in class", 0, $ex);
    }
    if (!isset($link)) {
      throw new NonDocumentedFeatureException("Class member not found in class");
    }
    return $link;
  }

  public function getClassName(): string {
    return $this->ref->getName();
  }

  public function getDefaultContent(): string {
    return $this->ref->getShortName();
  }

  public function getDefaultTitle(): string {
    return 'Documentation of ' . $this->ref->getShortName() . ' ' . $this->ref->getModifierNames($this->ref);
  }

  /**
   * 
   * @param  string $method
   * @return MethodLinker
   * @throws ReflectionException
   */
  public function methodLink(string $method): MethodLinker {
    if (str_ends_with($method, '()')) {
      $method = Strings::replace($method, '()', '');
    }
    return MethodLinker::create($this->getClassName(), $method, $this->urlGen, $this->cloneHyperlinkFactory());
  }

  public function constantLink(string $constName): ClassConstantLinker {
    return new ClassConstantLinker($this->ref->getReflectionConstant($constName), $this->urlGen, $this->cloneHyperlinkFactory());
  }

  public function propertyLink(string $propertyName): PropertytLinker {
    if (!$this->ref->hasProperty($propertyName)) {
      throw new NonDocumentedFeatureException('Property does not exist');
    }
    return new PropertytLinker($this->ref->getProperty($propertyName), $this->urlGen, $this->cloneHyperlinkFactory());
  }

  public function namespaceLink(): ?NamespaceLinker {
    $linker = null;
    if ($this->ref->inNamespace()) {
      $linker = new NamespaceLinker($this->ref->getNamespaceName(), $this->urlGen, $this->cloneHyperlinkFactory());
    }
    return $linker;
  }

  public function toShortlink(): A {
    return $this->toHyperlink($this->ref->getShortName());
  }

  /**
   * Creates a new BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return Span new instance
   */
  public function toInlineNavBar(): Span {
    $container = new Span();
    $trail = $this->toArray();
    $count = count($trail);
    foreach ($trail as $index => $link) {
      $container->append($link->toShortlink());
      if ($index < $count - 1) {
        $container->append(' <span class="slash">&#92;</span> ');
      }
    }
    return $container->addCssClass('php', 'api', 'namespace');
  }

  /**
   * Creates a new BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return Nav new instance
   */
  public function toNavBar(): Nav {
    $container = new Nav();
    $container->addCssClass('php', 'api', 'breadcrumbs');
    $type = Strings::convertCase($this->ref->getModifierNames(), MB_CASE_TITLE);
    $container->append('<span class="type-text">' . $type . "</span>");
    $trail = $this->toArray();
    $count = count($trail);
    foreach ($trail as $index => $link) {
      $container->append($link->toShortlink());
      if ($index < $count - 1) {
        $container->append(' <span class="slash">&#92;</span> ');
      }
    }
    return $container;
  }

  /**
   * Returns a BreadCrumbs component showing the trail of nested namespaces
   * 
   * @return A[] breadcrumb links showing the trail of nested namespaces
   */
  public function toArray(): array {
    if ($this->ref->inNamespace()) {
      $trail = $this->namespaceLink()->toArray();
    } else {
      $trail = [];
    }
    $trail[] = $this;
    return $trail;
  }

  public function getUrl(): string {
    return $this->urlGen->getClassUrl($this->ref->getName());
  }

  /**
   * Creates a new linker instance
   * 
   * @param  string $class the name of the class 
   * @param  ClassUrlGenerator $urlGen
   * @param  HyperlinkFactory|null $hyperlinkFactory
   * @return self new linker instance
   * @throws NonDocumentedFeatureException if execution fails
   */
  public static function create(string $class, ClassUrlGenerator $urlGen, ?HyperlinkFactory $hyperlinkFactory = null): self {
    try {
      return new self(new ClassReflector($class), $urlGen, $hyperlinkFactory);
    } catch (ReflectionException $ex) {
      throw new NonDocumentedFeatureException('Cannot create a class constant linker', 0, $ex);
    }
  }

}
