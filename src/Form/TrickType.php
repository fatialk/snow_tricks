<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Trick;
use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
