<?php

namespace App\Form;

use App\Entity\Artical;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ArticalAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('blogTitle', TextType::class, [
                'required'  => true,
                'attr'      => [
                    'class' => 'form-control',
                ],
                'row_attr'  => [
                    'class' => 'col-md-12'
                ],
                'constraints' => [
                    new Length([
                        'min'        => 3,
                        'minMessage' => 'Blog title should be more then {{ limit }} character',
                        'max'        => 150,
                    ]),
                ]
            ])
            ->add('blogContent', CKEditorType::class, [
                'config'      => [
                    'toolbar' => 'my_toolbar_1',
                    'height'  => '100px'
                ],
                'required'    => false,
                'row_attr'    => [
                    'class'   => 'col-md-12'
                ],
            ])
            ->add('imageFile', VichImageType::class, [
                'label'             => 'Upload Blog Image :',
                'download_uri'      => true,
                'download_label'    => 'Download',

                'row_attr'    => [
                    'class'   => 'col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-2'
                ],

                'attr'              => [
                    'accept' => 'image/jpeg, image/png',
                ],
            ])
            ->add('authorName', TextType::class, [
                'required'  => false,
                'attr'      => [
                    'class' => 'form-control',
                ],
                'row_attr'  => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('authorInfo', TextType::class, [
                'required'  => false,
                'attr'      => [
                    'class' => 'form-control',
                ],
                'row_attr'  => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('authorEmail', EmailType::class, [
                'required'  => false,
                'attr'      => [
                    'class' => 'form-control',
                ],
                'row_attr'  => [
                    'class' => 'col-md-6'
                ],
            ])
            ->add('authorMobile', NumberType::class, [
                'required'    => false,
                'attr'        => ['class' => 'form-control'],
                'row_attr'    => [
                    'class'   => 'col-md-6'
                ],
                'constraints' => [
                    new Length([
                        'min'        => 10,
                        'minMessage' => 'Mobile should be {{ limit }} numbers',
                        'max'        => 10,
                    ]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'          => Artical::class,
            'allow_extra_fields'  => true,
        ]);
    }
}
