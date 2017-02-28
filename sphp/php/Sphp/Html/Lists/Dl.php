<?php

/**
 * Dl.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
use IteratorAggregate;
use Sphp\Html\Attributes\AttributeManager;
use Sphp\Html\ContainerInterface;

/**
 * Implements an HTML &lt;dl&gt; tag
 *
 * The {@link self} component is used in conjunction with &lt;dt&gt; (defines the item in the list)
 * and &lt;dd&gt; (describes the item in the list).
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-23
 * @link    http://www.w3schools.com/tags/tag_dl.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dl extends AbstractContainerComponent implements IteratorAggregate, TraversableInterface {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   *
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   */
  public function __construct(AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct('dl', $attrManager, $contentContainer);
  }

  /**
   * Appends elements to the object
   *
   * @param  DlContentInterface $it list elements
   * @return self for a fluent interface
   */
  public function append(DlContentInterface $it) {
    $this->getInnerContainer()->append($it);
    return $this;
  }

  /**
   * Appends {@link Dt} term component to the list
   *
   * @param  mixed $terms the term component or its content
   * @return self for a fluent interface
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
   * Appends {@link Dd} description component to the list
   *
   * @param  mixed $descriptions the description components or their content
   * @return self for a fluent interface
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
   * @param  DlContentInterface $it list element
   * @return self for a fluent interface
   */
  public function prepend(DlContentInterface $it) {
    $this->getInnerContainer()->prepend($it);
    return $this;
  }

  public function count() {
    return $this->getInnerContainer()->count();
  }

  public function getIterator() {
    return $this->getInnerContainer();
  }

}
