<?php

namespace Sphp\Stdlib\Parsers;

$md = new Markdown();
echo $md->parseString(<<<MD
##Markdown markup language{#foo .foo}

[Markdown](https://daringfireball.net/projects/markdown/) is a lightweight markup language with plain text formatting syntax.
MD
);
