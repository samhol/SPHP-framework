<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Forms;

use Sphp\Html\Forms\Buttons\PushButton;
use Sphp\Html\Forms\Inputs\NumberInput;
use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\ToolBar;

/**
 * The NumberInput class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NumberInputToolBar extends AbstractContent {

  private PushButton $decr;
  private PushButton $incr;
  private NumberInput $input;
  private ToolBar $toolBar;

  public function __construct(string $name, int $value) {
    $this->input = new NumberInput($name, $value);
    //$this->input->readOnly();
    $this->decr = new PushButton('<i class="fas fa-minus"></i>');
    $this->decr->addCssClass('decr');
    $this->incr = new PushButton('<i class="fas fa-plus"></i>');
    $this->incr->addCssClass('incr');
    $this->toolBar = new ToolBar();
    $this->toolBar->appendButtonGroup()->append($this->decr)->addCssClass('me-1');
    $this->toolBar->appendInput($this->input);
    $this->toolBar->appendButtonGroup()->append($this->incr)->addCssClass('ms-1');
    $this->toolBar->addCssClass('number-input-toolbar');
  }

  public function __destruct() {
    unset($this->input, $this->decr, $this->incr, $this->toolBar);
  }

  public function getDecr(): PushButton {
    return $this->decr;
  }

  public function getIncr(): PushButton {
    return $this->incr;
  }

  public function getInput(): NumberInput {
    return $this->input;
  }

  public function getHtml(): string {
    return $this->toolBar->getHtml();
  }

}
