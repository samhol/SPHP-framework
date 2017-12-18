<?php

/**
 * Th.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;table&gt; tag's header cell (&lt;th&gt; tag)
 * 
 * This component defines a header cell in a {@link Table} component
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link http://www.w3schools.com/tags/tag_th.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Th extends AbstractCell {

  /**
   * Constructs a new instance
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
    return $this->setAttr('scope', $scope);
  }

  /**
   * Returns the value of the scope attribute
   *
   * @return string the value of the scope attribute
   * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   */
  public function getScope(): string {
    return (string) $this->getAttr('scope');
  }

}
