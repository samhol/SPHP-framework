<?php

/**
 * FreefindSearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Freefind;

use Sphp\Html\Foundation\Sites\Forms\SearchForm;

/**
 * Description of SearchForm
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FreefindSearchForm extends SearchForm {

  private $additionalControls = false;

  public function __construct(array $data = []) {
    parent::__construct('http://search.freefind.com/find.html', 'get');
    $this->setHiddenData($data);
  }

  public function getAdditionalControls() {
    return $this->additionalControls;
  }

  public function setAdditionalControls($additionalControls) {
    $this->additionalControls = $additionalControls;
    return $this;
  }

  public function contentToString(): string {
    if ($this->additionalControls) {
      $output = '<a href="http://search.freefind.com/find.html?si=51613081&amp;m=0&amp;p=0">sitemap</a> | ';
      $output .= '<a href="http://search.freefind.com/find.html?si=51613081&amp;pid=a">advanced</a>';
      return $output . parent::contentToString() .
              '<a href="http://www.freefind.com" >site search by <span style="color: #606060;">freefind</span></a>';
    } else {
      return parent::contentToString();
    }
  }

}
