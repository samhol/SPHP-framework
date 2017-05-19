<?php

/**
 * SearchForm.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Freefind;

use Sphp\Html\Forms\FormInterface;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Buttons\SubmitButton;

/**
 * Description of SearchForm
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-18
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SearchForm extends \Sphp\Html\AbstractComponent implements FormInterface {

  use \Sphp\Html\Forms\FormTrait;

  /**
   *
   * @var Submitter
   */
  private $submitButton;

  public function __construct() {
    parent::__construct('form');
    $this->setAction('http://search.freefind.com/find.html')
            ->setEnctype('utf-8')
            ->setMethod('get')
            ->setTarget('_self')
            ->identify('freefind');
    $this->setSubmitButton(new SubmitButton(\Sphp\Html\Icons\Icon::get('fa-search')));
  }

  public function getSubmitButton(): Submitter {
    return $this->submitButton;
  }

  /**
   * 
   * @param Submitter $submitButton
   * @return $this
   */
  public function setSubmitButton(Submitter $submitButton) {
    $this->submitButton = $submitButton;
    return $this;
  }

  public function contentToString() {
    $output = '<form action="http://search.freefind.com/find.html" method="get" accept-charset="utf-8" target="_self" id="freefind">
  <div class="input-group">
    <span class="input-group-label">Search for:</span>
    <input type="hidden" name="si" value="51613081">
    <input type="hidden" name="pid" value="r">
    <input type="hidden" name="n" value="0">
    <input type="hidden" name="_charset_" value="">
    <input type="hidden" name="bcd" value="&#247;">
    <input type="search" placeholder="keywords in documentation" class="input-group-field" name="query"> 
    <div class="input-group-button">
      <button type="submit" class="button" value="search" data-sphp-qtip-viewport="#freefind" data-sphp-qtip data-sphp-qtip-at="top center" data-sphp-qtip-my="bottom right" title="Execute search"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
  </div>
</form>

<a style="text-decoration:none; color:gray;" href="http://www.freefind.com" >site search</a><a style="text-decoration:none; color:gray;" href="http://www.freefind.com" > by
  <span style="color: #606060;">freefind</span></a>


<a href="http://search.freefind.com/find.html?si=51613081&amp;pid=a">advanced</a>';
    echo $output;
  }

  public function set($id) {
    
  }

  public function getData() {
    
  }

  public function setData(array $data = [], $filter = true) {
    
  }

}
