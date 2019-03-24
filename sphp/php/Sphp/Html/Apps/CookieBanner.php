<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps;

use Sphp\Html\Tags;

/**
 * Implements a CookieBanner
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CookieBanner extends \Sphp\Html\AbstractComponent {

  /**
   * @var 
   */
  private $text;
  /**
   * @var Button 
   */
  private $acceptBtn;

  public function __construct() {
    parent::__construct('div');
    $this->addCssClass('sphp', 'cookie-banner');
    $this->text = Tags::p()->appendMd('**SPHPlayground** uses cookies. By continuing we assume your 
      permission to deploy cookies, as detailed in our  [privacy policy](/manual/privacy_policy.php).');
    $this->acceptButton('<i class="far fa-check-circle"></i> Accept cookies');
  }

  public function acceptButton(string $button) {
    $this->acceptBtn = \Sphp\Html\Foundation\Sites\Buttons\Button::pushButton($button);
    $this->acceptBtn->addCssClass('button', 'accept');
    $this->acceptBtn->setAttribute('data-sphp-accept-cookies', true);
    return $this;
  }

  public function contentToString(): string {
    $row = new \Sphp\Html\Foundation\Sites\Grids\BasicRow();
    $row->appendCell($this->text . $this->acceptBtn)->shrink();
    return $row->addCssClass('align-center-middle')->getHtml();
  }

  public function getHtml(): string {
    if (!filter_has_var(INPUT_COOKIE, 'comply_cookie')) {
      return parent::getHtml();
    }
    return '';
  }

}
