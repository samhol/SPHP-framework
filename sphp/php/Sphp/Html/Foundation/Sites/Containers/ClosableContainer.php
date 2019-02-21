<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Core\ClosableInterface;
use Sphp\Html\Foundation\Sites\Controllers\CloseButton;

/**
 * Implements a Foundation Closable
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ClosableContainer extends Div implements ClosableInterface {

  /**
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructor
   *
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->closeButton = new CloseButton();
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return CloseButton
   */
  public function getCloseButton() {
    return $this->closeButton;
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return $this for a fluent interface
   */
  public function setCloseButton(CloseButton $btn) {
    $this->closeButton = $btn;
    return $this;
  }

  public function setClosable($closable = true) {
    $this->attributes()->setAttribute('data-closable', $closable);
    return $this;
  }

  public function isClosable(): bool {
    return $this->attributes()->isVisible('data-closable');
  }

  public function contentToString(): string {
    $output = parent::contentToString();
    if ($this->isClosable()) {
      $output .= $this->getCloseButton()->getHtml();
    }
    return $output;
  }

}
