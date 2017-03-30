<?php

namespace Sphp\Db;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$sqlException = $api->classLinker(SQLException::class);
$pdo = $php->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
#DATABASE MANIPULATION: {$api->namespaceLink(__NAMESPACE__)} namespace

The PHP Data Objects $pdo extension defines a lightweight, consistent interface
for accessing databases in PHP. In SPHP framework the $pdo extension is wrapped
into maybe more intuitive group of classes.

In all of the classes if any constraints are violated, the current database
operation is canceled and an $sqlException is returned instead.

Example database applicatíon:
MD
);
$usersTableSql = (new CodeExampleBuilder())
		->loadFromFile("Sphp/Db/create_users.sql")
		->setHeading("SQL code of the 'users' table")
		->printHtml();
CodeExampleBuilder::visualize("Sphp/Db/dbObjectsView.php", 1, "text");
CodeExampleBuilder::visualize("Sphp/Db/usersAsHtmlTable.php", 2);

$load("Sphp.Db.Db.php");
$load("Sphp.Db.Query.php");
$load("Sphp.Db.Insert.php");
$load("Sphp.Db.Update.php");
$load("Sphp.Db.Delete.php");
