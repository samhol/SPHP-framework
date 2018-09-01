<div class="grid-example grid-x grid-padding-x">
  <?php
  $div = new \Sphp\Html\Div('foo');
  $layout = new Sphp\Html\Foundation\Sites\Grids\CellLayoutManager($div);
  $div->setContent($div->cssClasses());
  $layout['small']['size'] = 1;
  echo $div;
  $layout['small']['size'] = 3;
  echo $div;
  $layout->screen('large')->clearOffset();
  $layout->screen('xxlarge');
  echo $div;
  $layout->setLayouts('xxlarge-3', 'foo');

  echo $div;
  $layout['small']['offset'] = 0;
  $layout->setLayouts('xxlarge-3', 'small-1')->screen('small')->order(1);
  $layout->screen('xxlarge')->order(2)->size(2);
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
  $layout1->auto()->screen('xlarge')->order(3);
  echo $div1->setAttribute('style', 'background: red;');
  ?>
</div>
<div class="grid-example grid-x">
  <div class="cell shrink xxlarge-11">erbge ree rt eregre e ger erg  egre e e rer </div>
</div>
