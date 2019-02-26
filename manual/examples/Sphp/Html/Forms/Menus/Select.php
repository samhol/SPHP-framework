<?php

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Html\Foundation\Sites\Forms\GridForm;

$cars = ['Sweden' => [
        'saab' => 'Saab',
        'volvo' => 'Volvo'
    ],
    'Germany' => [
        'audi' => 'Audi',
        'bmw' => 'BMW',
        'mb' => 'Mercedes-Benz',
        'opel' => 'Opel',
        'porsche' => 'Porsche',
        'vw' => 'Volkswagen'
    ],
    'Italy' => [
        'ferrari' => 'Ferrari',
        'fiat' => 'Fiat'
    ]
];

$carMenu = (new Select("cars[]"))
        ->setRequired(true)
        ->appendArray($cars)
        ->setSize(5)
        ->selectMultiple()
        ->setSelectedValues(['audi', 'porsche', 'volvo']);

$form = new GridForm();
$form->append([
    $carMenu,
    MenuFactory::rangeMenu(0, 15, 2, "range")->setSelectedValues(6)
]);
$form->printHtml();
