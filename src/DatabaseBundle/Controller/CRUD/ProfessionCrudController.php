<?php

namespace App\DatabaseBundle\Controller\CRUD;

use App\DatabaseBundle\Entity\Profession;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfessionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Profession::class;
    }
}