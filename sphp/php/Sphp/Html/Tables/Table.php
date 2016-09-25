<?php

/**
 * Table.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Core\Types\Strings;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\TraversableInterface;
/**
 * Class models an HTML &lt;table&gt; tag.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @link    http://www.w3schools.com/tags/tag_table.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Table extends AbstractContainerComponent implements TraversableInterface {

  
  use \Sphp\Html\TraversableTrait;
	/**
	 * Counts the {@link RowInterface} components in the table
	 */
	const COUNT_ROWS = 1;

	/**
	 * Counts the {@link CellInterface} components in the table
	 */
	const COUNT_CELLS = 2;

	/**
	 * Constructs a new instance
	 *
	 * @param  string $caption defines a table caption
	 */
	public function __construct($caption = "") {
		parent::__construct("table");
		$this->setup($caption);
	}

	/**
	 * Sets up the table
	 * 
	 * @param  string $caption defines a table caption
	 * @return self for PHP Method Chaining
	 */
	private function setup($caption) {
		$this->content()["caption"] = "";
		$this->content()["colgroup"] = "";
		$this->content()["thead"] = new Thead();
		$this->content()["tfoot"] = new Tfoot();
		$this->content()["tbody"] = new Tbody();
		$this->setCaption($caption);
		return $this;
	}

	/**
	 * Sets the caption text of the table
	 * 
	 * @param  string $caption the caption text of the table
	 * @return self for PHP Method Chaining
	 */
	public function setCaption($caption) {
		if (!Strings::isEmpty($caption)) {
			$this->content()["caption"] = new Caption($caption);
		} else if (isset($this->content()["caption"])) {
			$this->content()["caption"] = "";
		}
		return $this;
	}

	/**
	 * Clears the content of the table
	 *
	 * @return self for PHP Method Chaining
	 */
	public function clearContent() {
		foreach ($this as $id => $component) {
			if ($id == "colgroup") {
				$this->content()["colgroup"] = "";
			} else {
				$component->clear();
			}
		}
		return $this;
	}

	/**
	 * Sets (replaces) a part of a table with the given {@link TableContentInterface} component
	 *
	 * @param TableContentInterface $content the given part of a table
	 * @return self for PHP Method Chaining
	 */
	public function setContent(TableContentInterface $content) {
		if ($content instanceof Colgroup || $content instanceof Col) {
			$this->setCols($content);
		}  else if ($content instanceof Caption) {
			$this->content()["caption"] = $content;
		} else if ($content instanceof Thead) {
			$this->content()["thead"] = $content;
		} else if ($content instanceof Tbody) {
			$this->content()["tbody"] = $content;
		} else if ($content instanceof Tfoot) {
			$this->content()["tfoot"] = $content;
		} else if ($content instanceof Tr || $content instanceof Cell) {
			$this->content()["tbody"]->append($content);
		}
		return $this;
	}

	/**
	 * Sets the colgroup component
	 *
	 * the {@link Colgroup} component specifies a group of one or more columns 
	 *  in a {@link Table} for formatting
	 *
	 * @param  null|Col|Col[]|Colgroup column or column group
	 * @return self for PHP Method Chaining
	 */
	public function setCols($cols = null) {
		if ($cols === null) {
			$this->content()->set("colgroup", "");
		}
		else if ($cols instanceof Colgroup) {
			$this->content()->set("colgroup", $cols);
		} else {
			$this->content()->set("colgroup", new Colgroup($cols));
		}
		$this->content()["colgroup"];
		
		return $this;
	}

	/**
	 * Returns the colgroup component or null
	 *
	 * the {@link Colgroup} component specifies a group of one or more columns 
	 *  in a {@link Table} for formatting
	 *
	 * @return null|Colgroup table header content
	 */
	public function colgroup() {
		if ($this->content()["colgroup"] instanceof Colgroup) {
			return $this->content()["colgroup"];
		} else {
			return null;
		}
	}

	/**
	 * Returns the table header component
	 *
	 * @return Thead table header component
	 */
	public function thead() {
		return $this->content()["thead"];
	}

	/**
	 * Returns the table body component
	 *
	 * @return Tbody table body component
	 */
	public function tbody() {
		return $this->content()["tbody"];
	}

	/**
	 * Returns the table component
	 *
	 * @return Tfoot table footer component
	 */
	public function tfoot() {
		return $this->content()["tfoot"];
	}

	/**
	 * Count the number of inserted elements in the table
	 *
	 * **`$mode` parameter values:**
	 * 
	 * * {@link self::COUNT_ROWS} counts the {@link RowInterface} components in the table
	 * * {@link self::COUNT_CELLS} counts the {@link CellInterface} components in the table
	 *
	 * @param  int $mode defines the type of the objects to count
	 * @return int number of elements in the html table
	 * @link   http://php.net/manual/en/class.countable.php Countable
	 */
	public function count($mode = self::COUNT_CELLS) {
		if ($mode == self::COUNT_CELLS) {
			return $this->getComponentsByObjectType(Cell::class)->count();
		} else if ($mode == self::COUNT_ROWS) {
			return $this->getComponentsByObjectType(RowInterface::class)->count();
		} else {
			return $this->content()->count();
		}
	}

	/**
	 * Returns a {@link ContainerInterface} containing sub components that 
	 *  contain the searched attribute
	 *
	 * @param  string $attrName the name of the searched attribute
	 * @return ContainerInterface containing matching sub components
	 */
	public function getComponentsByAttrName($attrName) {
		return $this->content()->getComponentsByAttrName($attrName);
	}

	/**
	 * Create a new iterator to iterate through inserted elements in the table
	 *
	 * @return \ArrayIterator iterator
	 */
	public function getIterator() {
		return $this->content()->getIterator();
	}

}
