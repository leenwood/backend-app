<?php

namespace App\DatabaseBundle\Controller\CRUD;

use App\DatabaseBundle\Entity\EducationProgram;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class EducationProgramCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EducationProgram::class;
    }
}