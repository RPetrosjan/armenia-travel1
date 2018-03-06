<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
     public function buildForm(FormBuilderInterface $builder, array $options)
     {
         $builder
             ->add('image', FileType::class, array(
                 'label' => 'Add Image',
                 'data_class' => null,
                 'attr'   =>  array(
                     'class'   => 'c4fileimage'
                 ),
                 'required' => false,
             ))
             ->add('altimage',TextType::class,array(
                 'label' => 'Enter Image Alt',
             ))
             ->add('title',TextType::class,array(
                 'label' => 'Enter TitleImage'
             ))
             ->add('description',TextareaType::class,array(
                 'label' => 'Enter Description'
             ))
             ->add('url',TextType::class,array(
                 'label' => 'Enter url to page',
                 'required' => false,
                 'empty_data' => '',
             ))
         ;
     }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Image::class,
        ));
    }
}