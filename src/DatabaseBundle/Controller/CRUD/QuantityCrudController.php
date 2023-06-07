<?php

namespace App\DatabaseBundle\Controller\CRUD;

use App\DatabaseBundle\Entity\Quantity;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuantityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Quantity::class;
    }
}