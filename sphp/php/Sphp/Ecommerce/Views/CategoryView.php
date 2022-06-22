<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Views;

use Sphp\Html\AbstractContent;
use Sphp\Ecommerce\Data\Products;
use Sphp\Html\Forms\Buttons\SubmitButton;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Form;

/**
 * The CategoryController class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CategoryView extends AbstractContent {

  private Products $products;
  private ?string $selectedCat = null;

  public function __construct(Products $collection) {
    $this->products = $collection;
  }

  public function setSelectedCategory(?string $category = null) {
    $this->selectedCat = $category;
    return $this;
  }

  private function buildMenu(): Select {
    $cats = $this->products->getCategories();
    $select = new Select('cat');
    $select->appendOption('all', 'All');
    foreach ($cats as $cat) {
      $select->appendOption($cat, $cat);
    }
    $select->setInitialValue($this->selectedCat);
    return $select;
  }

  private function buildForm(): Form {
    $form = new Form();
    $form->append($this->buildMenu());
    $form->append(new SubmitButton('Select', 'foo'));
    return $form;
  }

  public function getHtml(): string {
    return (string) $this->buildForm();
  }

}
