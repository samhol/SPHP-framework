<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\View\Components;

use Sphp\Html\AbstractContent;
use Sphp\Html\Component;
use Sphp\Network\Headers\Cookies;
use Sphp\Html\Layout\Section;
use Sphp\Html\Layout\Div;
use Sphp\Html\Forms\Buttons\PushButton;
use Stringable;

/**
 * Implements a CookieBanner
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieBanner extends AbstractContent {

  private Div $component;
  private string $complyCookieName = 'comply_cookie';
  private Section $text;
  private PushButton $acceptBtn;

  public function __construct() {
    $this->component = new Div();
    $this->component->addCssClass('sphp', 'cookie-banner-container');
    $this->text = new Section();
    $this->text->addCssClass('text');
    $this->setAcceptButton('<i class="far fa-check-circle"></i> Accept cookies');
  }

  public function __destruct() {
    unset($this->acceptBtn, $this->text);
  }

  public function setComplyCookieName(string $name = 'comply_cookie') {
    $this->complyCookieName = $name;
    return $this;
  }

  public function contentContainer(): Section {
    return $this->text;
  }

  public function setAcceptButton(PushButton|Stringable|string $button): Component {
    if (!$button instanceof Component) {
      $button = new PushButton($button);
      $button->addCssClass('btn btn-success accept btn-lg');
    }
    $this->acceptBtn = $button;
    $this->acceptBtn->setAttribute('data-sphp-accept-cookies-button', true);
    return $this->acceptBtn;
  }

  public function buildContent(): string {

    $row = new Div();
    $row->addCssClass('sphp cookie-banner');
    $row->append($this->text);
    $row->appendHr();
    $row->appendDiv($this->acceptBtn)->addCssClass('p-4 text-center');
    // $row->addCssClass('align-center-middle');
    $this->component->append($row);
    return $this->component->getHtml();
  }

  public function getHtml(): string {
    if (!Cookies::exists($this->complyCookieName)) {
      return $this->buildContent();
    }
    return '';
  }

}
