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
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-08-28
 * @link http://www.w3schools.com/tags/tag_th.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Th extends Cell {

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
   * @param string|null $scope the value of the scope attribute or null for none
   * @param int $colspan solun colspan attribute value
   * @param int $rowspan solun rowspan attribute value
   * @link  http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   * @link  http://www.w3schools.com/tags/att_th_colspan.asp colspan attribute
   * @link  http://www.w3schools.com/tags/att_th_rowspan.asp rowspan attribute
   */
  public function __construct($content = null, $scope = null, $colspan = 1, $rowspan = 1) {
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
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   */
  public function setScope($scope) {
    return $this->setAttr('scope', $scope);
  }

  /**
   * Returns the value of the scope attribute
   *
   * @return string the value of the scope attribute
   * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
   */
  public function getScope() {
    return $this->getAttr('scope');
  }

}
