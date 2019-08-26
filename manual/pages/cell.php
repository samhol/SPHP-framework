<pre>
  <?php
  print_r(array_map('str_getcsv', file('./manual/snippets/example.csv')));
  ?>
<span class="devicon-atom-original"></span>
<div data-sphp-ajax-replace="/sphp/javascript/vendor/anytime.c.localization.php?lang=fi_FI"></div>
</pre>
<?php
$div = new \Sphp\Html\Div();
$div->inlineStyles()->setProperty('border', 'solid #222 1px')->setProperty('white-space', 'pre');
$div->ajaxAppend('/sphp/javascript/vendor/anytime.c.localization.php?lang=fi_FI');
echo $div;
