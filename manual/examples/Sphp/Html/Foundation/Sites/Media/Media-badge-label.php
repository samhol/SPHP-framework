<?php

namespace Sphp\Html\Foundation\Sites\Media;

for ($i = 1; $i < 11; $i++) {
  $badge = Media::badge($i);
  echo $badge;
}
echo Media::badge('a', 'alert');

for ($i = 1; $i < 11; $i++) {
  $badge = Media::badge($i);
  echo $badge;
}
echo Media::label('foo.pdf');
echo Media::pdfLabel('foo')->addCssClass('small');
echo Media::phpLabel('foo')->addCssClass('small');
