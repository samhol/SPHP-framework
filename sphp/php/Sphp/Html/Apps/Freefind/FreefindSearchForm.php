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
 * @since   2017-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FreefindSearchForm extends SearchForm {

  private $pid, $si, $bcd;
  private $additionalControls = false;

  public function __construct($pid = '', $si = '', $bcd = '', $n = '') {

    parent::__construct('http://search.freefind.com/find.html', 'get');
    $this->setBcd($bcd)->setN($n)->setPid($pid)->setSi($si);
  }

  public function getAdditionalControls() {
    return $this->additionalControls;
  }

  public function setAdditionalControls($additionalControls) {
    $this->additionalControls = $additionalControls;
    return $this;
  }

  /**
   * 
   * @param  string $pid the value of the hidden attribute
   * @return self for a fluent interface
   */
  public function setPid($pid) {
    $this->getHiddenData()['pid'] = $pid;
    return $this;
  }

  /**
   * 
   * @param  string $si the value of the hidden attribute
   * @return self for a fluent interface
   */
  public function setSi($si) {
    $this->getHiddenData()['si'] = $si;
    return $this;
  }

  /**
   * 
   * @param  string $bcd the value of the hidden attribute
   * @return self for a fluent interface
   */
  public function setBcd($bcd) {
    $this->getHiddenData()['bcd'] = $bcd;
    return $this;
  }

  /**
   * 
   * @param  string $n the value of the hidden attribute
   * @return self for a fluent interface
   */
  public function setN($n) {
    $this->getHiddenData()['n'] = $n;
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
