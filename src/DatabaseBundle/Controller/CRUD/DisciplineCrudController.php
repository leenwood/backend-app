<?php

namespace App\DatabaseBundle\Controller\CRUD;

use App\DatabaseBundle\Entity\Discipline;
use App\DatabaseBundle\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DisciplineCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Discipline::class;
    }
}