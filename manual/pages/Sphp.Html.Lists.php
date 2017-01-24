<?php

namespace Sphp\Html\Lists;

$htmlListLink = $api->classLinker(HtmlList::class);
$ol = $api->classLinker(Ol::class);
$ulLink = $api->classLinker(Ul::class);
$liInterface = $api->classLinker(LiInterface::class);
$li = $api->classLinker(Li::class);
$dlLink = $api->classLinker(Dl::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML LISTS: <small>unordered, ordered and definition lists</small>{#lists}
$ns	
This namespace contains object oriented implementations for Unordered , 
Ordered, and Description lists.
		
##$htmlListLink extensions ($ulLink and $ol components)
		
Instances of $htmlListLink, $ulLink and $ol classes wrap all inserted content not implementing
$liInterface into a $li object. 
		
MD
);

$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Lists/Ul.php', false, true);

echo $parsedown->text(<<<MD
##Ordered lists: <small>The $ol component</small>
        
The $ol component (an ordered list) supports indexing in the generated HTML output. 
This indexing can be numerical or alphabetical.

* {$ol->methodLink("setType", FALSE)}: sets the kind of marker used in the list
  * `'1'`: Decimal numbers (1, 2, 3, 4) **Default**
  * `'a'`: Alphabetically ordered list, lowercase (a, b, c, d)
  * `'A'`: Alphabetically ordered list, uppercase (A, B, C, D)
  * `'i'`: Roman numbers, lowercase (i, ii, iii, iv)
  * `'I'`: Roman numbers, uppercase (I, II, III, IV)
* {$ol->methodLink("setStart", FALSE)}: sets the start value of the list ordering index
		
MD
);

$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Lists/Ol.php', false, true);

$dtLink = $api->classLinker(Dt::class);
$ddLink = $api->classLinker(Dd::class);
echo $parsedown->text(<<<MD
##Definition lists: <small>The $dlLink component</small>
	
The $dlLink component is a list of $dtLink terms and $ddLink descriptions for thee terms.
$dtLink - $ddLink groups may be terms and definitions, metadata topics and values, questions 
and answers, or any other groups of name-value data.

MD
);

$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Lists/Dl.php', false, true);