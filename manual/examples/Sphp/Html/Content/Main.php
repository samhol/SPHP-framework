<?php

namespace Sphp\Html\Flow;

$main = new Main();
$h1 = $main->appendH1('Main heading');
$article1 = $main->appendArticle();
$article1->appendH1('Article 1');
$article1->appendParagraph()->appendMd('An **ARTICLE** specifies independent, self-contained content.');
$article2 = $main->appendArticle();
$article1->appendH1('Article 2');
$article1->appendParagraph('An article should make sense on its own and it '
        . 'should be possible to distribute it independently from the rest of the site.');
echo $main;
