<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Component;
use Sphp\Html\Layout\Div;
use Sphp\Html\Text\Headings\H5;
use Sphp\Bootstrap\Exceptions\BootstrapException;

/**
 * The Modal class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Modal extends AbstractComponent {

  private $viewports = [
      'always' => 'modal-fullscreen',
      'sm-down' => 'modal-fullscreen-sm-down',
      'md-down' => 'modal-fullscreen-md-down',
      'lg-down' => 'modal-fullscreen-lg-down',
      'xl-down' => 'modal-fullscreen-xl-down',
      'xxl-down' => 'modal-fullscreen-xxl-down'];
  private Div $dialog;
  private H5 $header;
  private Div $body;
  private Div $footer;

  public function __construct() {
    parent::__construct('div');
    $this->initModal();
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->dialog, $this->header, $this->body, $this->footers);
  }

  public function createTrigger($trigger): Component {
    if (!$trigger instanceof Component) {
      $trigger = new \Sphp\Html\Forms\Buttons\PushButton($trigger);
    }
    $this->initTrigger($trigger);
    return $trigger;
  }

  public function initTrigger(Component $trigger): Component {
    $trigger->setAttribute('data-bs-toggle', 'modal')
            ->setAttribute('data-bs-target', '#' . $this->identify());
    return $trigger;
  }

  private function initModal(): void {
    // $this->identify();
    $this->addCssClass('modal fade');
    $this->setAttribute('tabindex', -1);
    $this->setAttribute('aria-hidden', 'true');
    $this->buildDialog();
  }

  public function setVerticallyCentered(bool $centered = true) {
    if ($centered) {
      $this->dialog->addCssClass('modal-dialog-centered');
    } else {
      $this->dialog->removeCssClass('modal-dialog-centered');
    }
    return $this;
  }

  public function setScrollable(bool $scrollable = true) {
    if ($scrollable) {
      $this->dialog->addCssClass('modal-dialog-scrollable');
    } else {
      $this->dialog->removeCssClass('modal-dialog-scrollable');
    }
    return $this;
  }

  /**
   * Sets the modal size
   * 
   * * small: 'sm' or 'modal-sm'
   * * large: 'lg' or 'modal-lg'
   * * default: 'default'
   * * x-large: 'xl' or 'modal-xl'
   * 
   * @param  string $size
   * @return $this for a fluent interface
   * @throws BootstrapException if the size parameter is invalid
   */
  public function setSize(string $size = 'default') {
    if ($size !== 'default' && !str_starts_with($size, 'modal-')) {
      $size = "modal-$size";
    }
    $sizes = ['modal-sm', 'modal-lg', 'modal-xl'];
    if ($size !== 'default' && !in_array($size, $sizes)) {
      throw new BootstrapException('Invalid modal size parameter provided');
    }
    $this->dialog->removeCssClass(...$sizes);
    if ($size !== 'default') {
      $this->dialog->addCssClass($size);
    }
    return $this;
  }

  /**
   * Sets fullscreen modal
   * 
   * <var>$viewport</var>:
   * * 'always' or 'modal-fullscreen': Modal is always fullscreen 
   * * 'sm-down' or 'modal-fullscreen-sm-down': Modal is fullscreen below 576px
   * * 'md-down' or 'modal-fullscreen-md-down': Modal is fullscreen below 768px
   * * 'lg-down' or 'modal-fullscreen-lg-down': Modal is fullscreen below 992px
   * * 'xl-down' or 'modal-fullscreen-xl-down': Modal is fullscreen below 1200px
   * * 'xxl-down' or 'modal-fullscreen-xxl-down': Modal is fullscreen below 1400px
   * * 'never': Modal is never fullscreen 
   * 
   * @param  string $viewport
   * @return $this for a fluent interface
   * @throws BootstrapException if the viewport parameter is invalid
   */
  public function setFullScreen(string $viewport = 'always') {
    if (array_key_exists($viewport, $this->viewports)) {
      $viewport = $this->viewports[$viewport];
    }
    if ($viewport !== 'never' && !in_array($viewport, $this->viewports)) {
      throw new BootstrapException('Invalid viewport parameter provided');
    }
    $this->dialog->removeCssClass(...array_values($this->viewports));
    if ($viewport !== 'never') {
      $this->dialog->addCssClass($viewport);
    }
    return $this;
  }

  public function getHeader(): H5 {
    return $this->header;
  }

  public function getFooter(): Div {
    return $this->footer;
  }

  public function getBody(): Div {
    return $this->body;
  }

  private function buildDialog(): void {
    $this->dialog = new Div();
    $this->dialog->addCssClass('modal-dialog');
    $content = $this->dialog->appendDiv()->addCssClass('modal-content');
    $headerContainer = $content->appendDiv();

    $this->header = $headerContainer->appendH5();
    $this->header->addCssClass('modal-title');
    $headerContainer->append('<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>');
    $headerContainer->addCssClass('modal-header');
    $this->body = $content->appendDiv()->addCssClass('modal-body');
    $this->footer = $content->appendDiv()->addCssClass('modal-footer');
  }

  public function contentToString(): string {
    return $this->dialog->getHtml();
  }

}
