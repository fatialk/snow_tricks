<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Trick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('category')
            ->add('description')
            ->add('illustrations', FileType::class, [
                'label' => 'Illustrations',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'multiple' => true,

                // unmapped fields can't define their validation using attributes
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new All([
                        'constraints' => [
                            new File([
                                'maxSize' => '1024k',
                                'mimeTypes' => [
                                    'image/png',
                                    'image/jpeg',
                                ],
                                'mimeTypesMessage' => 'Please upload a valid image',
                            ]),
                        ],
                      ]),
                ],
            ])
            ->add('videos', TextareaType::class,
            ['label' => 'Videos (Veuillez saisir les embeds séparés par des retours à la ligne)' , 'attr' => ['rows' => 10 ]]
            )
        ;

        $builder->get('videos')
            ->addModelTransformer(new CallbackTransformer(
                function ($videosAsArray): string {
                    // transform the array to a string
                    return implode(PHP_EOL, $videosAsArray);
                },
                function ($videosAsArray): array {
                    // transform the string back to an array
                    return explode(PHP_EOL, $videosAsArray);
                }
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
