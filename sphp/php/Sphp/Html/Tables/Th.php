<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

/**
 * Implements a &lt;th&gt; header cell for an HTML &lt;table&gt;
 * 
 * @author Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_th.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Th extends AbstractCell {

  /**
   * Constructor
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @precondition  $scope == row|col|rowgroup|colgroup
   * @precondition  $colspan >= 1
   * @precondition  $rowspan >= 1
   * @param mixed $content the content of the tag
   * @param int $colspan specifies the number of columns cell should span
   * @param int $rowspan specifies the number of rows cell should span
   * @param string|null $scope the value of the scope attribute or null for none
   * @link  http://www.w3schools.com/tags/att_th_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_th_rowspan.asp rowspan attribute
   * @link  http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   */
  public function __construct($content = null, int $colspan = 1, int $rowspan = 1, string $scope = null) {
    parent::__construct('th', $content);
    if ($scope !== null) {
      $this->setScope($scope);
    }
    $this->setColspan($colspan)
            ->setRowspan($rowspan);
  }

  /**
   * Sets the value of the scope attribute
   *
   * @precondition  $scope == row|col|rowgroup|colgroup
   * @param  string $scope the value of the scope attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   */
  public function setScope(string $scope = null) {
    return $this->setAttribute('scope', $scope);
  }

  /**
   * Returns the value of the scope attribute
   *
   * @return string the value of the scope attribute
   * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   */
  public function getScope(): string {
    return (string) $this->getAttribute('scope');
  }

}
