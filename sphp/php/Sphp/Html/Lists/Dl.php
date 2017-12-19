<?php

/**
 * Dl.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableContent;
use IteratorAggregate;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\ContainerInterface;
use Traversable;

/**
 * Implements an HTML &lt;dl&gt; tag
 *
 * The {@link self} component is used in conjunction with &lt;dt&gt; (defines the item in the list)
 * and &lt;dd&gt; (describes the item in the list).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_dl.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dl extends AbstractContainerComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   */
  public function __construct(HtmlAttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct('dl', $attrManager, $contentContainer);
  }

  /**
   * Appends elements to the object
   *
   * @param  DlContent $it list elements
   * @return $this for a fluent interface
   */
  public function append(DlContent $it) {
    $this->getInnerContainer()->append($it);
    return $this;
  }

  /**
   * Creates and appends a term to the list
   *
   * @param  mixed $content the term content
   * @return Dt appended instance
   */
  public function appendTerm($content): Dt {
    $dt = new Dt($content);
    $this->append($dt);
    return $dt;
  }

  /**
   * Appends {@link Dt} term component to the list
   *
   * @param  mixed $terms the term component or its content
   * @return $this for a fluent interface
   */
  public function appendTerms($terms) {
    foreach ((is_array($terms)) ? $terms : [$terms] as $term) {
      if (!($term instanceof DlContentInterface)) {
        $term = new Dt($term);
      }
      $this->append($term);
    }
    return $this;
  }

  /**
   * Creates and appends a description to the list
   *
   * @param  mixed $content the description content
   * @return Dt appended instance
   */
  public function appendDescription($content): Dd {
    $dd = new Dd($content);
    $this->append($dd);
    return $dd;
  }

  /**
   * Appends {@link Dd} description component to the list
   *
   * @param  mixed $descriptions the description components or their content
   * @return $this for a fluent interface
   */
  public function appendDescriptions($descriptions) {
    foreach ((is_array($descriptions)) ? $descriptions : [$descriptions] as $description) {
      if (!($description instanceof DlContentInterface)) {
        $description = new Dd($description);
      }
      $this->append($description);
    }
    return $this;
  }

  /**
   * Prepends an item to the object
   * 
   * @param  DlContent $it list element
   * @return $this for a fluent interface
   */
  public function prepend(DlContent $it) {
    $this->getInnerContainer()->prepend($it);
    return $this;
  }

  public function count(): int {
    return $this->getInnerContainer()->count();
  }

  public function getIterator(): Traversable {
    return $this->getInnerContainer();
  }

}
