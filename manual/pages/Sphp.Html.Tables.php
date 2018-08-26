<?php

namespace Sphp\Html\Tables;

use Sphp\Manual;

$table = Manual\api()->classLinker(Table::class);
$tr = Manual\api()->classLinker(Tr::class);
$td = Manual\api()->classLinker(Td::class);
$th = Manual\api()->classLinker(Th::class);
$cell =  Manual\api()->classLinker(Cell::class);
$caption = Manual\api()->classLinker(Caption::class);
$colgroup = Manual\api()->classLinker(Colgroup::class);
$col = Manual\api()->classLinker(Col::class);
$thead =  Manual\api()->classLinker(Thead::class);
$tbody =  Manual\api()->classLinker(Tbody::class);
$tfoot =  Manual\api()->classLinker(Tfoot::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$w3schools = Manual\w3schools();
Manual\md(<<<MD
#HTML tables: <small>for tabular data</small>

$ns

Namespace contains object oriented PHP implementation of the HTML table structure. 
Table element represents tabular data —that is, information expressed via a 
two-dimensional data table. Therefore <u>HTML tables should not be used as layout aids</u>.

##The $table component 
		
The structure of a $table object follows closely the specification of a HTML $w3schools->table.

 * The $caption class specifies the caption (or title) of a table
 * The $colgroup class defines a group of columns within a table
   * The $col class defines a column within a table and is used for defining 
   common semantics on all common cells. An instance of it is always within a 
   $colgroup object.
 * The $thead class defines a set of rows defining the head of the columns of the table.
 * The $tbody class groups one or more rows as the body of a table.
 * The $tbody class groups one or more rows as the body of a table.
   * The $tr class defines a row of cells in a table. Those are implementaitions of $cell interface.
     * The $th class implements $cell as header of a group of table cells.
     * The $td class implements $cell as data container.
MD
);
Manual\example('Sphp/Html/Tables/Table.php', null, true)
        ->setExamplePaneTitle('HTML table example')
        ->printHtml();

$tableBuilder = Manual\api()->classLinker(TableBuilder::class);
$lineNumberer =  Manual\api()->classLinker(LineNumberer::class);
Manual\md(<<<MD
##TABLE FACTORIES: <small>Table building and manipulation</small>

$tableBuilder is able to generate HTML tables from data sources. 
A $lineNumberer instance makes it possible to add linenumbers to a table object. 
MD
);
Manual\example('Sphp/Html/Tables/TableBuilder.php')
        ->setExamplePaneTitle('HTML table builder example')
        ->printHtml();
Manual\md(<<<MD
###HTML TABLES FROM CSV-FILES: <small>The $tableBuilder Class as a factory</small>

{$tableBuilder->methodLink('fromCsvFile')} is a factory method for generating tables from CSV files.
MD
);
Manual\example('Sphp/Html/Tables/Factory.php')
        ->setExamplePaneTitle('HTML table factory example')
        ->printHtml();
Manual\example('Sphp/Html/Tables/LineNumberBuilder.php')
        ->setExamplePaneTitle('HTML table factory example')
        ->printHtml();
