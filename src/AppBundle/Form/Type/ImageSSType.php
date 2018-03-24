<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 08.03.2018
 * Time: 00:41
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\ImageSS;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageSSType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', ['label' => 'Image'] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ImageSS::class,
        ));
    }
}