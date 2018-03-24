<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 06.03.2018
 * Time: 23:52
 */

namespace AppBundle\Form\Type;


use AppBundle\AppBundle;
use AppBundle\Entity\DestinationDays;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestionationDaysType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleDays',TextType::class,array(
                'label' => 'Title.Days',
                'required' => false,
                'translation_domain' => 'messages',
            ))
            ->add('descriptionDays',TextareaType::class,array(
                'label' => 'Description',
                'required' => false,
            ))
            ->add('file', 'file', array(
                'label' => 'Add Image',
                'attr'   =>  array(
                    'class'   => 'c4fileimage'
                ),
                'required' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DestinationDays::class,
        ));
    }


}