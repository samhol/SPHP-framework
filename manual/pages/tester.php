<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;
echo "<pre>";
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'auto') === 1);
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'medium-auto') === 1);
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'medium-1') === 1);
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'medium-12') === 1);
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'xxlarge-12') === 1);
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'xxlarge-auto') === 1);
var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'large-offset-2') === 1);
echo "</pre>";
$grid = new Grid();
$column = new Column('foo', ['small-auto', 'medium-6', 'large-auto']);
$grid->append(Row::from([$column, 'bar', 'baz']));
echo $grid;
?>
<div class="grid-example">
  <div class="grid-x grid-margin-x">
    <div class="small-12 cell">4 cells</div>
    <div class="auto cell">Whatever's left!</div>
    <div class="auto cell">Whatever's left!</div>
  </div>
</div>
scheme://[user:pass@]domain:port/path?query#fragment

