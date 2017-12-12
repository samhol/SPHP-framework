<?php

/**
 * Tr.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;tr&gt; tag
 *
 *  This component represents a row of {@link CellInterface}
 *  components in a {@link Table}.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tr extends AbstractRow {

  /**
   * Creates a new &lt;tr&gt; component
   * 
   * @param  array $tds 
   * @return Tr created &lt;tr&gt; component
   */
  public static function fromTds(array $tds): Tr {
    return (new static())->appendTds($tds);
  }

  /**
   * Creates a new &lt;tr&gt; component
   * 
   * @param  array $ths
   * @return Tr created &lt;tr&gt; component
   */
  public static function fromThs(array $ths): Tr {
    return (new static())->appendThs($ths);
  }

}
