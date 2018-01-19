<?php

/**
 * InputGroup.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\TextualInputInterface;
use Sphp\Html\Forms\Inputs\NumberInput;
use Sphp\Html\Span;
use Sphp\Html\Container;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Traversable;
use Sphp\Html\Forms\Buttons\ButtonInterface;
use Sphp\Html\Forms\Inputs\Factory;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\ComponentInterface;
use Sphp\Html\Forms\Inputs\Buttons\Submitter;
use Sphp\Html\Forms\Inputs\Buttons\Resetter;

/**
 * Class InputGroup
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputGroup extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Container 
   */
  private $group;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->protect("input-group");
    $this->group = new Container;
  }

  /**
   * Appends a span label to the group
   *
   * @param  mixed $content the content of the prefix
   * @return ComponentInterface appended instance
   */
  public function prepend($content): ComponentInterface {
    if ($content instanceof TextualInputInterface || $content instanceof NumberInput) {
      $content->addCssClass('input-group-field');
      $this->group->prepend($content);
    } else if (is_string($content) || $content instanceof Span) {
      if (!$content instanceof Span) {
        $content = new Span($content);
      }
      $content->addCssClass('input-group-label');
      $this->prepend($content);
    } else if ($content instanceof ButtonInterface) {
      $this->group->prepend($content);
    } else {
      throw new InvalidArgumentException("Content appended to inputgroup is invalid type");
    }
    return $content;
  }

  /**
   * Appends a span label to the group
   *
   * @param  mixed $content the content of the prefix
   * @return ComponentInterface appended instance
   */
  public function append($content): ComponentInterface {
    if ($content instanceof TextualInputInterface || $content instanceof NumberInput) {
      $content->addCssClass('input-group-field');
      $this->group->append($content);
    } else if (is_string($content) || $content instanceof Span) {
      $this->appendLabel($content);
    } else if ($content instanceof ButtonInterface) {
      $this->group->append($content);
    } else {
      throw new InvalidArgumentException("Content appended to inputgroup is invalid type");
    }
    return $content;
  }

  /**
   * Appends a span label to the group
   *
   * @param  mixed $content the content of the prefix
   * @return Span appended instance
   */
  public function appendLabel($content): Span {
    if (!$content instanceof Span) {
      $content = new Span($content);
    }
    $content->addCssClass('input-group-label');
    $this->group->append($content);
    return $content;
  }

  /**
   * Creates and appends an input to the group
   * 
   * @param  string $type
   * @param  string $name
   * @param  scalar $value
   * @return TextualInputInterface appended instance
   */
  public function appendInput(string $type, string $name = null, $value = null): TextualInputInterface {
    $input = Factory::$type($name, $value);
    $input->addCssClass('input-group-field');
    $this->group->append($input);
    return $input;
  }

  /**
   * Appends a submitter to the group
   *
   * @param  string|null $value the value of value attribute
   * @param  string|null $name the value of name attribute
   * @return Submitter appended instance
   */
  public function appendSubmitter(string $value = null, string $name = null): Submitter {
    $submitter = new Submitter($value, $name);
    $this->group->append($submitter);
    return $submitter;
  }

  /**
   * Appends a submitter to the group
   *
   * @param  string|null $value the value of value attribute
   * @param  string|null $name the value of name attribute
   * @return Resetter appended instance
   */
  public function appendResetter(string $value = null): Resetter {
    $submitter = new Resetter($value);
    $this->group->append($submitter);
    return $submitter;
  }

  public function contentToString(): string {
    $output = '';
    foreach ($this as $component) {
      if ($component instanceof ButtonInterface) {
        $component->addCssClass('button');
        $output .= '<div class="input-group-button">' . $component . '</div>';
      } else {
        $output .= $component;
      }
    }
    return $output;
  }

  public function count(): int {
    return $this->group->count();
  }

  public function getIterator(): Traversable {
    return $this->group->getIterator();
  }

}
