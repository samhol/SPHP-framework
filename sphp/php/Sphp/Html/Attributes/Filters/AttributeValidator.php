<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Attributes\Filters;

/**
 * Description of AttributeFilter
 *
 * @author samih
 */
class AttributeValidator implements AttributeDataParser {
  //put your code here
  public function filter($rawData): array {
    return [];
  }

  public function getErrors(): \Sphp\I18n\Collections\TranslatableCollection {
    
  }

  public function isValid($value): bool {
    return true;
  }

}
