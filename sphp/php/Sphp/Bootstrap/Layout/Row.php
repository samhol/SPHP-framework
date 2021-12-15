<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;
 
use Sphp\Bootstrap\Exceptions\BootstrapException;
use Sphp\Stdlib\Strings;
use IteratorAggregate;
use Traversable;
use Sphp\Html\ContentIterator;
use Sphp\Stdlib\Arrays; 


/**
 * The RowColumn class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Row extends AbstractResponsiveComponent implements IteratorAggregate {

  /**
   * @var Col[]
   */
  private array $cols;
  private array $gutters = [0, 1, 2, 3, 4, 5];

  public function __construct(array $settings = []) {
    $this->cols = [];
    $defaults = array_merge(['prefix' => 'row-cols'], $settings);
    parent::__construct('div', $defaults);
    $this->addCssClass('row');
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->cols);
  }

  public function __clone() {
    parent::__clone();
    $this->cols = Arrays::copy($this->cols);
  }

  /**
   * 
   * @param  string $params
   * @return $this for a fluent interface
   * @throws BootstrapException
   */
  public function setGutters(string ... $params) {
    $bbStr = implode('|', $this->getBreakpoints());
    $regexp = "/^(g(x|y)?(-($bbStr))?(-[0-5]))$/";
    foreach ($params as $param) {
      if (!Strings::match($param, $regexp)) {
        throw new BootstrapException("Invalid gutter type given ($param)");
      }
      $type = preg_replace('/(-(0|1|2|3|4|5))?/', '', $param);
      $this->unsetGutters($type);
      $this->addCssClass($param);
    }
    return $this;
  }

  public function unsetGutters(string ... $params) {
    $bbStr = implode('|', $this->getBreakpoints());
    $sizes = implode('|', $this->gutters);
    $validGutterType = "/^(g(x|y)?(-($bbStr))?)$/";
    $validGutter = "/^(g(x|y)?(-($bbStr))?(-($sizes)))$/";
    if (count($params) === 0) {
      $this->cssClasses()->removePattern($validGutter);
    } else {
      foreach ($params as $param) {
        if (Strings::match($param, $validGutter)) {
          $this->cssClasses()->remove($param);
        } else if (Strings::match($param, $validGutterType)) {
          $this->cssClasses()->removePattern("/^($param)(-($sizes))$/");
        } else {
          throw new BootstrapException("Invalid gutter type given ($param)");
        }
      }
    }
    return $this;
  }

  /**
   * Appends a new Column to the row
   * 
   * @param  mixed $column column or column content
   * @return AbstractCol new column
   */
  public function appendColumn($column = null): AbstractCol {
    if (!$column instanceof AbstractCol) {
      $out = new Col();
      $out->append($column);
      $this->cols[] = $out;
    } else {
      $out = $column;
      $this->cols[] = $out;
    }
    return $out;
  }

  /**
   * Create a new iterator to iterate through Row content
   *
   * @return Traversable<int, Col> iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->cols);
  }

  public function contentToString(): string {
    return implode('', $this->cols);
  }

}
