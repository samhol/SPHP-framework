<?php

namespace Sphp\Html\Lists;

use Sphp\Manual;

$htmlList = Manual\api()->classLinker(StandardList::class);
$ol = Manual\api()->classLinker(Ol::class);
$ul = Manual\api()->classLinker(Ul::class);
$liInterface = Manual\api()->classLinker(LiInterface::class);
$li = Manual\api()->classLinker(Li::class);
$dlLink = Manual\api()->classLinker(Dl::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$w3schools = Manual\w3schools();

Manual\md(<<<MD
#HTML lists: <small>unordered, ordered and definition lists</small>
$ns	
This namespace contains object oriented implementations of HTML lists.

##Unrdered lists: <small>The $ul component</small>{#ul}

The $ul class implements an unordered (bulleted) list (The $w3schools->ul).

Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create unordered lists.
Instances of $htmlList, $ul and $ol classes wrap all inserted content not implementing
$liInterface into a $li object. 
		
MD
);

Manual\visualize('Sphp/Html/Lists/Ul.php', null, true);

Manual\md(<<<MD
##Ordered lists: <small>The $ol component</small>{#ol}
        
The $ol component (an ordered list) extends $htmlList. It supports indexing in the generated HTML output. 
This indexing can be numerical or alphabetical.

* {$ol->methodLink("setListType", FALSE)}: sets the kind of marker used in the list
  * `'1'`: Decimal numbers (1, 2, 3, 4) **Default**
  * `'a'`: Alphabetically ordered list, lowercase (a, b, c, d)
  * `'A'`: Alphabetically ordered list, uppercase (A, B, C, D)
  * `'i'`: Roman numbers, lowercase (i, ii, iii, iv)
  * `'I'`: Roman numbers, uppercase (I, II, III, IV)
* {$ol->methodLink("setStart", FALSE)}: sets the start value of the list ordering index
		
MD
);

Manual\visualize('Sphp/Html/Lists/Ol.php', null, true);

$dtLink = Manual\api()->classLinker(Dt::class);
$ddLink = Manual\api()->classLinker(Dd::class);
Manual\md(<<<MD
##Definition lists: <small>The $dlLink component</small>
	
The $dlLink component is a list of $dtLink terms and $ddLink descriptions for thee terms.
$dtLink - $ddLink groups may be terms and definitions, metadata topics and values, questions 
and answers, or any other groups of name-value data.

MD
);

Manual\visualize('Sphp/Html/Lists/Dl.php', null, true);
Manual\md(<<<MD
###References:

* [<b>w3schools.com</b>: HTML Lists](http://www.w3schools.com/html/html_lists.asp){target=_blank}
* http://www.w3schools.com/tags/tag_ul.asp
* http://www.w3schools.com/tags/tag_ol.asp
* http://www.w3schools.com/tags/tag_li.asp
 
MD
);
