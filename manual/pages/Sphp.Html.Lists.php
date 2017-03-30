<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$htmlList = Apis::apigen()->classLinker(AbstractList::class);
$ol = Apis::apigen()->classLinker(Ol::class);
$ul = Apis::apigen()->classLinker(Ul::class);
$liInterface = Apis::apigen()->classLinker(LiInterface::class);
$li = Apis::apigen()->classLinker(Li::class);
$dlLink = Apis::apigen()->classLinker(Dl::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML LISTS: <small>unordered, ordered and definition lists</small>{#lists}
$ns	
This namespace contains object oriented implementations of HTML lists.

##Unrdered lists: <small>The $ul component</small>{#ul}

The $ul class implements an unordered (bulleted) list (The {$w3schools->tag('ul')}).

Use the &lt;ul&gt; tag together with the &lt;li&gt; tag to create unordered lists.
Instances of $htmlList, $ul and $ol classes wrap all inserted content not implementing
$liInterface into a $li object. 
		
MD
);

CodeExampleBuilder::visualize('Sphp/Html/Lists/Ul.php', false, true);

echo $parsedown->text(<<<MD
##Ordered lists: <small>The $ol component</small>{#ol}
        
The $ol component (an ordered list) extends $htmlList. It supports indexing in the generated HTML output. 
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

CodeExampleBuilder::visualize('Sphp/Html/Lists/Ol.php', false, true);

$dtLink = Apis::apigen()->classLinker(Dt::class);
$ddLink = Apis::apigen()->classLinker(Dd::class);
echo $parsedown->text(<<<MD
##Definition lists: <small>The $dlLink component</small>{#dl}
	
The $dlLink component is a list of $dtLink terms and $ddLink descriptions for thee terms.
$dtLink - $ddLink groups may be terms and definitions, metadata topics and values, questions 
and answers, or any other groups of name-value data.

MD
);

CodeExampleBuilder::visualize('Sphp/Html/Lists/Dl.php', false, true);
echo $parsedown->text(<<<MD
###References:{#refs}
        
* [<b>w3schools.com</b>: HTML Lists](http://www.w3schools.com/html/html_lists.asp){target=_blank}
* http://www.w3schools.com/tags/tag_ul.asp
* http://www.w3schools.com/tags/tag_ol.asp
* http://www.w3schools.com/tags/tag_li.asp
        
        
MD
);
