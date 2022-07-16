<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Forms;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Label;
use Sphp\Html\Component;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\InputFactory;
use Sphp\Bootstrap\Exceptions\BadMethodCallException;

/**
 * The InputGroup class
 *
 * 
 * @method static self text(mixed $content = null, $for = null) creates a &lt;input type=hidden&gt; object
 * @method static self search(mixed $content = null, $for = null) creates a search input
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class InputGroup extends AbstractComponent {

  private PlainContainer $container;
  private ?Input $input = null;

  /**
   * Constructor
   *
   * @param Input|null $input
   */
  public function __construct(?Input $input = null) {
    parent::__construct('div');
    $this->container = new PlainContainer;
    if ($input !== null) {
      $this->appendInput($input);
    }
    $this->cssClasses()->protectValue('input-group');
  }

  public function appendInput(Input $input) {
    if ($input instanceof Select) {
      $input->addCssClass('form-select');
    } else {
      $input->addCssClass('form-control');
    }
    $this->container->append($input);
    $this->input = $input;
    return $this;
  }

  public function prependLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('input-group-text');
    $this->container->prepend($label);
    return $label;
  }

  public function appendLabel($content): Label {
    $label = new Label($content, $this->input);
    $label->addCssClass('input-group-text');
    $this->container->append($label);
    return $label;
  }

  public function prepend($content) {
    $this->container->prepend($content);
    return $this;
  }

  public function append($content) {
    $this->container->append($content);
    return $this;
  }

  public function appendButton(Component $button): Component {
    $button->addCssClass('btn');
    $this->container->append($button);
    return $button;
  }

  public function contentToString(): string {
    return $this->container->getHtml();
  }

  /**
   * 
   * @param  string $name
   * @param  array $args
   * @return InputGroup
   * @throws BadMethodCallException
   */
  public static function __callStatic(string $name, array $args): InputGroup {
    try {
      return new InputGroup(InputFactory::$name(...$args));
    } catch (\Error $ex) {
      throw new BadMethodCallException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
