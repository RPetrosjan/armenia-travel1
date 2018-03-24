<?php
/**
 * Created by PhpStorm.
 * User: Win10
 * Date: 07.03.2018
 * Time: 21:40
 */

namespace AppBundle\Admin;

use AppBundle\Entity\DestinationDays;
use AppBundle\Form\Type\DestinationStickerType;
use AppBundle\Form\Type\DestionationDaysType;
use AppBundle\Form\Type\ImageType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\BooleanType;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostImageAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab($this->trans('Destination globale'))
            ->with('General', ['class' => 'col-md-3'])
            ->add('nameDestination', TextType::class,array(
                'label' => $this->trans('Destination'),
                'attr' => array(
                    'class' => 'col-md-8',
                ),
            ))
            ->add('description', TextType::class, array(
                'label' => $this->trans('Code description'),
                'attr' => array(
                    'maxlength' => 10,
                    'class' => 'col-xs-3',

                ),
            ))
            ->end()
            ->with('Settings',['class' => 'col-md-3'])
            ->add('activeDestination',CheckboxType::class,array(
                'label' => $this->trans('Active'),
                'required' => false,
            ))
            ->add('inbound', CheckboxType::class,array(
                'label' => $this->trans('inboundtours'),
                'required' => false,
            ))
            ->end()
            ->with('Data',['class' => 'col-md-3'])
            ->add('StartDateDestination',DatePickerType::class,array(
                'label' => $this->trans('Start Action'),
                'format' => 'd/M/y'
            ))
            ->add('EndDateDestination',DatePickerType::class,array(
                'label' => $this->trans('End Action'),
                'format' => 'd/M/y'
            ))
            ->end()
            ->with('Stickers')
            ->add('destinationsticker',CollectionType::class,array(
                'label' => $this->trans('Sticker'),
                'entry_type' => DestinationStickerType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ))
            ->end()
            ->with($this->trans('Description Blocks Images'))
            ->add('allimages',CollectionType::class,array(
                'label' => $this->trans('Sticker'),
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ))
            ->end()
            ->end()
            ->tab($this->trans('Destination Days'))
            ->with($this->trans('Background Image'))

            ->add('allimagesdestinationdays',CollectionType::class,array(
                'label' => $this->trans('Sticker'),
                'entry_type' => DestionationDaysType::class,
                'allow_add' => true,
                'allow_delete' => true,
            ))

            ->end()
            ->end()

            ->tab($this->trans('SEO'))
            ->with('UrlPage, Title, KeyWords, Facebook, Twitter, Google')
                ->add('urlpage', TextType::class, array(
                    'label' => 'Url '.$this->trans('Page').' :  destination/',
                ))
                ->add('titlepage', TextType::class, array(
                    'label' => 'Title '.$this->trans('page'),
                ))
                ->add('descriptionpage', TextType::class, array(
                    'label' => 'Description '.$this->trans('page'),
                ))
                ->add('keywordpage', TextType::class, array(
                    'label' => 'Keywords '.$this->trans('page'),
                ))
                ->add('facebookpage', TextType::class, array(
                    'label' => 'Facebook '.$this->trans('page'),
                ))
                ->add('googlepage', TextType::class, array(
                    'label' => 'Google '.$this->trans('page'),
                ))
                ->add('twitterpage', TextType::class, array(
                    'label' => 'Twitter '.$this->trans('page'),
                ))

            ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('nameDestination')
        ;
    }

    public function getFormTheme()
    {
        dump( parent::getFormTheme());
        return array_merge(
            parent::getFormTheme(),
            array('myfield_edit.html.twig')
        );

        ///   return
        ///      array('myfield_edit.html.twig');
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nameDestination')
            ->add('inbound')
            ->add('description')
            ->add('imagetype')
            ->add('StartDateDestination')
            ->add('EndDateDestination')
            ->add('destinationsticker')
        ;
    }

    protected function configureListFields(ListMapper $listField)
    {
        $listField
                ->add('activeDestination','boolean',array(
                    'editable' => true,
                ))
                ->add('nameDestination','text',array(
                    'label' => $this->trans('Destination'),
                    'editable' => true,
                ))
                ->add('inbound','boolean',array(
                    'label' => $this->trans('inboundtours'),
                    'editable' => true,
                ))
                ->addIdentifier('_action','actions',array(
                    'actions' => array(
                        'show' => array(),
                        'edit' => array(),
                        'delete' => array(),
                    )
                ))
            ;
        ;
    }


}