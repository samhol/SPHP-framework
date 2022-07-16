<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Accordions;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Stringable;
use Traversable;
use Sphp\Html\ContentIterator;

/**
 * Implements an Foundation Accordion
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/accordion.html Foundation Accordion
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Accordion extends AbstractComponent implements IteratorAggregate {

  /**
   * @var Pane[] 
   */
  private array $panels;
  private bool $allwaysOpen = true;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->protectValue('accordion');
    $this->identify();
    $this->panels = [];
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->panels);
  }

  /**
   * Prepends a pane component
   * 
   * @param  Pane $pane added component
   * @return $this for a fluent interface
   */
  public function prepend(Pane $pane) {
    if (!$this->allwaysOpen) {
      $pane->setAccordionParent($this);
    }
    array_unshift($this->panels, $pane);
    return $this;
  }

  /**
   * Appends a pane component
   * 
   * @param  Pane $pane added pane component
   * @return $this for a fluent interface
   */
  public function append(Pane $pane) {
    if (!$this->allwaysOpen) {
      $pane->setAccordionParent($this);
    }
    $this->panels[] = $pane;
    return $this;
  }

  /**
   * Creates and appends a new HTML pane component
   * 
   * @param  string|Stringable $title the content of the pane title
   * @param  mixed $content the content of the actual pane
   * @return ContentPane appended instance
   */
  public function appendPane(string|Stringable $title, $content = null): ContentPane {
    $pane = new ContentPane($title, $content);
    $this->append($pane);
    return $pane;
  }

  public function allowAllOpen(bool $open) {
    foreach ($this->panels as $pane) {
      if ($open) {
        $pane->setAccordionParent(null);
      } else {

        $pane->setAccordionParent($this);
      }
    }
  }

  /**
   * Returns a new iterator to iterate through inserted components 
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->panels);
  }

  public function contentToString(): string {
    return implode($this->panels);
  }

}
