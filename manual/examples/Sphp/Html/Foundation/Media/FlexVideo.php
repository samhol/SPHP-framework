<?php

namespace Sphp\Html\Foundation\Media;

use Sphp\Html\Foundation\Structure\Grid as Grid;
use Sphp\Html\Foundation\Structure\Row as Row;
use Sphp\Html\media\YoutubePlayer as YoutubePlayer;

$flex[] = (new FlexVideo("CdMs7eqMvNg", FlexVideo::YOUTUBE))
		->setLazy();
$flex[] = (new FlexVideo())
		->setPlayer(new YoutubePlayer("WwrpLgWyAjU"))
		->setLazy();
$flex[] = (new FlexVideo())
		->setSource(112233728, FlexVideo::VIMEO)
		->setLazy();

$grid = (new Grid(new Row($flex)))
		->printHtml();
?>