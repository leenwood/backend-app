<?php

namespace App\DatabaseBundle\Controller\CRUD;

use App\DatabaseBundle\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }
}