<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\TextualInputInterface;
use Sphp\Html\Component;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Span;
use Sphp\Html\PlainContainer;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Traversable;
use Sphp\Html\Forms\Buttons\ButtonInterface;
use Sphp\Html\Forms\Inputs\FormControls;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Buttons\Resetter;

/**
 * Class InputGroup
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InputGroup extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var PlainContainer 
   */
  private $group;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->protectValue('input-group');
    $this->group = new PlainContainer;
  }

  public function __destruct() {
    unset($this->group);
    parent::__destruct();
  }

  /**
   * Appends a span label to the group
   *
   * @param  mixed $content the content of the prefix
   * @return Component appended instance
   */
  public function prepend($content): Component {
    if ($content instanceof Input && $content instanceof CssClassifiableContent) {
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
   * @return Component appended instance
   */
  public function append(Component $content) {
    if ($content instanceof Input && $content instanceof CssClassifiableContent) {
      $content->addCssClass('input-group-field');
      $this->group->append($content);
    } else if (is_string($content)) {
      $this->appendLabel($content);
    } else {
      $this->group->append($content);
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
    $input = FormControls::$type($name, $value);
    $input->addCssClass('input-group-field');
    $this->group->append($input);
    return $input;
  }

  public function appendButton(Component $button): Component {
    $button->addCssClass('button');
    $this->group->append($button);
    return $button;
  }

  /**
   * Appends a submitter to the group
   *
   * @param  mixed $content the visual content of the button
   * @param  string|null $name the value of name attribute
   * @return Submitter appended instance
   */
  public function appendSubmitter($content = 'submit', string $name = null): Submitter {
    $submitter = new Submitter($content, $name);
    $this->appendButton($submitter);
    return $submitter;
  }

  /**
   * Appends a submitter to the group
   *
   * @param  mixed $content the visual content of the button
   * @return Resetter appended instance
   */
  public function appendResetter($content = 'reset'): Resetter {
    $submitter = new Resetter($content);
    $this->group->appendButton($submitter);
    return $submitter;
  }

  public function contentToString(): string {
    $output = '';
    foreach ($this->group as $component) {
      if ($component instanceof Component && $component->hasCssClass('button')) {
        //echo "button:" . get_class($component);
        if ($component instanceof \Sphp\Html\Foundation\Sites\Containers\Dropdown) {
          $output .= '<div class="input-group-button">' . $component->getTrigger() . '</div>' . $component->getDropdown();
        } else {
          $output .= '<div class="input-group-button">' . $component . '</div>';
        }
      } else {
        $output .= $component;
      }
    }
    return $output;
  }

  public function getIterator(): Traversable {
    return $this->group->getIterator();
  }

}
