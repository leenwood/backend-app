<?php

namespace App\AdminBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class SettingsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('openAIApiKey', TextType::class, [
                'label' => 'Open API KEY LABEL (RENAME PLEASE)',
                'help' => 'Input API KEY from open AI',
                'help_attr' => [
                    'class' => 'form-text text-muted'
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'save',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'font-size: 25px; padding: 5px 25px;'
                ],
            ]);
    }

}