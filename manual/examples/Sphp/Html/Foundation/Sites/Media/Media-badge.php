<?php

namespace Sphp\Html\Foundation\Sites\Media;

for ($i = 1; $i < 11; $i++) {
  $badge = Media::badge($i);
  echo $badge;
}
echo Media::badge('a', 'alert');
