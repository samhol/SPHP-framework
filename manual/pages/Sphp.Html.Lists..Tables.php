<?php

namespace Sphp\Html\Lists;
use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleAccordion;

$htmlListLink = $api->classLinker(HtmlList::class);
$ol = $api->classLinker(Ol::class);
$ulLink = $api->classLinker(Ul::class);
$liInterface = $api->classLinker(LiInterface::class);
$li = $api->classLinker(Li::class);
$dlLink = $api->classLinker(Dl::class);
echo $parsedown->text(<<<MD
#HTML LISTS AND HTML TABLES
		
This section introduces PHP implementations of HTML lists and tables in SPHP framework.
	
##HTML LISTS: {$api->namespaceLink(__NAMESPACE__)} namespace

This namespace contains object oriented implementations for Unordered Lists $ulLink, 
Ordered Lists $ol, and Description Lists $dlLink.
		
###$htmlListLink extensions ($ulLink and $ol components)
		
Instances of $htmlListLink, $ulLink and $ol classes wrap all inserted content not implementing
$liInterface into a $li object. 

Furthermore the $ol component (an ordered list) introduces some additional functionality for list item 
indexing in the generated HTML output. This indexing can be numerical or alphabetical.

* {$ol->method("setType", FALSE)}: sets the kind of marker used in the list
  * `'1'`: Decimal numbers (1, 2, 3, 4) **Default**
  * `'a'`: Alphabetically ordered list, lowercase (a, b, c, d)
  * `'A'`: Alphabetically ordered list, uppercase (A, B, C, D)
  * `'i'`: Roman numbers, lowercase (i, ii, iii, iv)
  * `'I'`: Roman numbers, uppercase (I, II, III, IV)
* {$ol->method("setStart", FALSE)}: sets the start value of the list ordering index
		
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Lists/Ul.php', false, true);

$dtLink = $api->classLinker(Dt::class);
$ddLink = $api->classLinker(Dd::class);
echo $parsedown->text(<<<MD
####The $dlLink component implements an HTML Definition list
	
The $dlLink component is a list of $dtLink terms and $ddLink descriptions for thee terms.
$dtLink - $ddLink groups may be terms and definitions, metadata topics and values, questions 
and answers, or any other groups of name-value data.

MD
);

$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Lists/Dl.php', false, true);

namespace Sphp\Html\Tables;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleAccordion;

$tableClass = $api->classLinker(Table::class);
$tr = $api->classLinker(Tr::class);
$td = $api->classLinker(Td::class);
$th = $api->classLinker(Th::class);
echo $parsedown->text(<<<MD
##HTML TABLES: {$api->namespaceLink(__NAMESPACE__)} namespace

Namespace contains object oriented PHP implementation of the HTML table structure. 
This namespace implements most of the features of the HTML tables.

###The $tableClass component 
		
The $tableClass class implements the HTML {$w3schools->tag("table")}. In general $tableClass 
components (just like HTML tables) should not be used as layout aids.
		
A basic $tableClass is divided into rows with the $tr component (the tr stands for table row).
A row is divided into data cells with the $td tag. (td stands for table data)
A row can also be divided into headings with the $th tag. (th stands for table heading)
The $td elements are the data containers in the $tableClass.
The $td elements can contain all sorts of HTML elements like text, images, lists, other tables, etc.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Tables/basics.php', false, true);

$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Tables/Table2.php', false, true);
