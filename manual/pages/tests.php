<div class="grid-example grid-x">
  <?php
  $div = new \Sphp\Html\Div('foo');
  $layout = new Sphp\Html\Foundation\Sites\Grids\CellLayoutManager($div);
  $div->setContent($div->cssClasses());
  $layout['small']['size'] = 2;
  echo $div;
  $layout['small']['size'] = 1;
  echo $div;
  $layout->screen('large')->unsetOffsets();
  $layout->screen('xxlarge');
  echo $div;
  $layout->setLayouts('xxlarge-3', 'foo');
  $layout['small']['offset'] = 1;
  echo $div;
  $layout->setLayouts('xxlarge-3', 'foo')->screen('small')->setOrders(1);
  echo $div;
  ?>
</div>
<div class="grid-example grid-x">
  <?php
  $div1 = new \Sphp\Html\Div('foo');
  $layout1 = new Sphp\Html\Foundation\Sites\Grids\CellLayoutManager($div1);
  $div1->setContent($div1->cssClasses());
  $layout1->screen('small')->size(4);
  echo $div1;
  $layout1->screen('small')->size(2);
  echo $div1;
  echo $div1;
  $layout1->shrink();
  echo $div1;
  $layout1->auto()->screen('xlarge')->setOrders(3);
  echo $div1->setAttribute('style', 'background: red;');
  ?>
</div>
