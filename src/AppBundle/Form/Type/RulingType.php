<?php

declare(strict_types=1);

namespace AppBundle\Form\Type;

use AppBundle\Entity\Ruling;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RulingType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class)
            ->add('source', TextType::class)
            ->add('link', TextType::class);
    }

    public function configureOptions (OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'      => Ruling::class,
                'csrf_protection' => false,
            ]
        );
    }
}
