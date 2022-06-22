<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Navigation;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Li;
use Sphp\Html\TraversableContent;
use Traversable;

/**
 * Class Pagination
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Pagination extends AbstractComponent implements IteratorAggregate, TraversableContent {

  private Ul $links;

  /**
   * Constructor
   * 
   * @param string $ariaLabel
   */
  public function __construct(string $ariaLabel = null) {
    parent::__construct('nav');
    $this->setAttribute('aria-label', $ariaLabel);
    $this->links = new Ul;
    $this->links->addCssClass('pagination flex-wrap');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->links);
  }

  public function __clone() {
    parent::__clone();
    $this->links = clone $this->links;
  }

  public function prependLink(string $url, string $content, string $target = null): Link {
    $link = Link::create($url, $content, $target);
    $this->links->prepend($link);
    return $link;
  }

  public function appendLink(string $url, string $content, string $target = null): Link {
    $link = Link::create($url, $content, $target);
    $this->links->append($link);
    return $link;
  }

  /**
   * 
   * @return Li 
   */
  public function prependEllipsis(): Li {
    $ellipsis = new Li('<span class="page-link"> . . . </span>');
    $ellipsis->cssClasses()->protectValue('ellipsis page-item disabled');
    $ellipsis->attributes()->protect('aria-hidden', 'true');
    $this->links->prepend($ellipsis);
    return $ellipsis;
  }

  /**
   * 
   * @return Li 
   */
  public function appendEllipsis(): Li {
    $ellipsis = new Li('<span class="page-link"> . . . </span>');
    $ellipsis->cssClasses()->protectValue('ellipsis page-item disabled');
    $ellipsis->attributes()->protect('aria-hidden', 'true');
    $this->links->append($ellipsis);
    return $ellipsis;
  }

  public function setAlignment(string $param) {
    $this->links->addCssClass($param);
    return $this;
  }

  public function contentToString(): string {
    return $this->links->getHtml();
  }

  public function count(): int {
    return $this->links->count();
  }

  public function getComponentsBy(callable $rules): TraversableContent {
    return $this->links->getComponentsBy($rules);
  }

  public function getComponentsByObjectType($typeName): TraversableContent {
    return $this->links->getComponentsByObjectType($typeName);
  }

  public function toArray(): array {
    return $this->links->toArray();
  }

  public function getIterator(): Traversable {
    return $this->links->getIterator();
  }

}
