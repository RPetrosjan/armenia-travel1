<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 28.02.2018
 * Time: 12:05
 */

namespace AppBundle\Form\Type;


use AppBundle\Entity\DestinationStickers;
use AppBundle\Entity\Sticker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationStickerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sticker',EntityType::class,array(
               'class' => Sticker::class,
                'expanded' => true,
            ))
            ->add('fieldSticker',TextType::class,array(
                'label' => 'Name',
                'required' => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DestinationStickers::class,
        ));
    }

    public function getFormTheme()
    {

    }


}