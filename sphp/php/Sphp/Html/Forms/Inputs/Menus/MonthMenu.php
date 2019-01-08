<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Forms\Inputs\Menus;

/**
 * Description of MonthMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthMenu implements SelectMenuInterface {

  use \Sphp\Html\TraversableTrait,
      \Sphp\Html\ContentTrait;

  private $menu;

  public function __construct($name) {
    $cal = new \Sphp\I18n\Datetime\CalendarUtils();
    $this->menu = Select::from($name, $cal->getMonths());
  }

  public function count(): int {
    
  }

  public function disable(boolean $disabled = true): \this {
    
  }

  public function getHtml(): string {
    
  }

  public function getName() {
    
  }

  public function getOptions(): \Sphp\Html\TraversableContent {
    
  }

  public function getSelectedOptions(): \Sphp\Html\TraversableContent {
    
  }

  public function getSubmitValue() {
    
  }

  public function isEnabled(): bool {
    
  }

  public function isNamed(): bool {
    
  }

  public function isRequired(): bool {
    
  }

  public function selectMultiple(boolean $multiple = true): \this {
    
  }

  public function setName(string $name): \this {
    
  }

  public function setRequired(boolean $required = true): \this {
    
  }

  public function setSelectedValues($selectedValues): \this {
    
  }

  public function setSize(int $size = null): \this {
    
  }

  public function setSubmitValue($value): \this {
    
  }

}
