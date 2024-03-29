<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Inputs\Menus\Datalist;
use Sphp\Html\Forms\Inputs\Menus\Option;
/**
 * Implementation of an HTML input type="text|password|email|tel| ...))" tag
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractTextualInput extends InputTag implements TextualInput {

  private ?Datalist $datalist = null;

  /**
   * Constructor
   *
   * @precondition  `0 < $size <= $maxlength`
   * @param  string $type the value of the type attribute
   * @param  string|null $name the value of the  name attribute
   * @param  scalar|null $value the value of the  value attribute
   * @param  int $maxlength the value of the  maxlength attribute
   * @param  int $size the value of the  size attribute
   * @link   https://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   https://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   * @link   https://www.w3schools.com/tags/att_input_size.asp size attribute
   */
  public function __construct(string $type = 'text', ?string $name = null, $value = null, ?int $maxlength = null, ?int $size = null) {
    parent::__construct($type, $name, $value);
    if ($maxlength > 0) {
      $this->setMaxlength($maxlength);
    }
    if ($size > 0) {
      $this->setSize($size);
    }
  }

  /**
   * 
   * @param  Option|String|int|float $options
   * @return $this for a fluent interface
   */
  public function useDatalist(Menus\Option|String|int|float ... $options) {
    $this->setDataList(new Datalist(...$options));
    return $this;
  }

  public function setDataList(Datalist|array|null $datalist): ?Datalist {
    if ($datalist === null) {
      $this->datalist = null;
      $this->removeAttribute('list');
    } else if (!$datalist instanceof Datalist) {
      $this->datalist = new Datalist();
      $this->datalist->appendData($datalist);
      $this->setAttribute('list', $this->datalist->identify());
    } else {
      $this->datalist = $datalist;
      $this->setAttribute('list', $this->datalist->identify());
    }
    return $this->datalist;
  }

  public function getHtml(): string {
    return parent::getHtml() . $this->datalist;
  }

  public function setSize(?int $size) {
    $this->attributes()->setAttribute('size', $size);
    return $this;
  }

  public function setMaxlength(?int $maxlength) {
    $this->attributes()->setAttribute('maxlength', $maxlength);
    return $this;
  }

  public function setPlaceholder(?string $placeholder) {
    $this->attributes()->setAttribute('placeholder', $placeholder);
    return $this;
  }

  public function autocomplete(bool $allow = true) {
    $this->attributes()->setAttribute('autocomplete', $allow ? 'on' : 'off');
    return $this;
  }

  public function readOnly(bool $readOnly = true) {
    $this->attributes()->setAttribute('readonly', $readOnly);
    return $this;
  }

  public function setPattern(?string $pattern) {
    $this->attributes()->setAttribute('pattern', $pattern);
    return $this;
  }

  public function getPattern(): ?string {
    return $this->attributes()->getValue('pattern');
  }

  public function hasPattern(): bool {
    return $this->attributes()->isVisible('pattern');
  }

}
