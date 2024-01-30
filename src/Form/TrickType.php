<?php

namespace App\Form;

use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class TrickType extends AbstractType
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        //Get last url
        $url[] = array_values(array_filter(explode('/', $this->requestStack->getCurrentRequest()->getPathInfo())));

        $builder
            ->add('name')
            ->add('category')
            ->add('description')
            ->add('images', CollectionType::class, [
                'entry_type' => ImagesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'prototype' => true,
                'label' => ''
            ])->add('videos', CollectionType::class, [
                'entry_type' => VideosType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'prototype' => true,
                'label' => ''
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
